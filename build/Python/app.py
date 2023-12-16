from flask import Flask
from flask import jsonify, request
import random
import json
import torch
import spacy 
from langdetect import detect
from model import NeuralNet
from nltk_utils import bag_of_words, tokenize, is_question, detect_intent, is_request
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import requests
import os
import re 

app = Flask(__name__)

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')
nlp = spacy.load("fr_core_news_sm")

def infer_information_type(input):
    if not isinstance(input, str):
        input = str(input)  # Convert input to string if it's not already
    detected_language = detect(input)
    doc = nlp(input)

    info_type_mapping = {
       "définition": ["qu'est-ce que", "qu'est-ce qu'", "qu'est", "c'est quoi"],
        "date": ["quand"],
        "lieu": ["où"],
        "personne": ["qui"],
        "raison": ["pourquoi"],
        "procédure": ["comment"]
    }

    for token in doc:
        for info_type, triggers in info_type_mapping.items():
            for trigger in triggers:
                if trigger in token.text.lower():
                    return info_type
    return None

vectorizer = TfidfVectorizer()

def extract_movie_or_manga_name(input):
    pattern = r"(du (manga|film) [^?]+)"
    match = re.search(pattern, input, re.IGNORECASE)
    if match: 
        return match.group(0)
    else:
        return None


def get_response(input, bot_name):

    path_to_intent = os.path.join('intents', bot_name, 'intents.json')
    with open(path_to_intent, 'r') as data:
        intents = json.load(data)

    FILE = os.path.join('intents', bot_name, 'data.pth')
    data = torch.load(FILE)

    input_size = data["input_size"]
    hidden_size = data["hidden_size"]
    output_size = data["output_size"]
    all_words = data['all_words']
    tags = data['tags']
    model_state = data["model_state"]

    model = NeuralNet(input_size, hidden_size, output_size).to(device)
    model.load_state_dict(model_state)
    model.eval()

    bot_name = "Sam"

    detected_language = detect(input)
    input = tokenize(input, language=detected_language)
    X = bag_of_words(input, all_words, language=detected_language)
    X = X.reshape(1, X.shape[0])
    X = torch.from_numpy(X).to(device)

    output = model(X)
    _, predicted = torch.max(output, dim=1)

    tag = tags[predicted.item()]

    probs = torch.softmax(output, dim=1)
    prob = probs[0][predicted.item()]

    
    info_type = infer_information_type(input)
    extract = extract_movie_or_manga_name(input)
    if extract : 
        random_number = random.randint(0, 1)
        if random_number == 1 : 
            return "Je trouve que {extract} est captivant et nous plonge dans un monde riche et passionnant. Les personnages sont bien développés et attachants, l'histoire est fluide et pleine de rebondissements, et je trouve les images magnifiques. Je recommande {extract} à tous les fans du genre."
        else : 
            return "{extract} est une oeuvre audacieuse qui ne manquera pas de vous surprendre. L'histoire est unique et bien construite, les personnages sont complexes et intéressants, et je trouve l'image complétement novatrice. Je recommande cela à tous ceux cherchant quelque chose de nouveau."


    if prob.item() > 0.75:
        for intent in intents['intents']:
            if tag == intent['tag']:
                responses = intent['responses']
                if info_type is not None and info_type in responses:
                    response = random.choice(responses[info_type])
                else : 
                    response = random.choice(intent['responses'])
                return response 
    else:
            return "Je ne comprends pas... Pouvez-vous reformuler ?"



@app.route('/api/chatbot', methods=['POST'])
def chatbot_endpoint():
    data = request.get_json()
    user_message = data['message']
    bot_name = data['bot_name']
    bot_response = get_response(user_message, bot_name)
    return jsonify({'response': bot_response})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

import spacy
from flask import Flask
from flask import jsonify, request
import random
import json
import torch
from langdetect import detect
from model import NeuralNet
from nltk_utils import bag_of_words, tokenize, is_question, detect_intent, is_request
import requests

app = Flask(__name__)

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

with open('intents.json', 'r') as json_data:
    intents = json.load(json_data)

FILE = "data.pth"
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

def infer_information_type(input):
    detected_language = detect(input)
    keywords = tokenize(input, language=detected_language)
    phrases = nltk.sent.tokenize(input)

    info_type_mapping = {
        "quoi": "definition",
        "qu'est": "définition",
        "quand": "date",
        "où": "lieu",
        "qui": "personne",
        "pourquoi": "raison",
        "comment": "procédure"
    }

    info_type= None
    for keyword in keywords:
        if keyword in info_type_mapping:
            info_type = info_type_mapping[keyword]
            break
    for phrases in phrases:
        if phrases.lower() in info_type_mapping:
            info_type = info_type_mapping[phrase.lower()]
            break
    return info_type


def get_response(input):
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
    if prob.item() > 0.7:
        for intent in intents['intents']:
            if tag == intent["tag"]:
                return random.choice(intent['responses'])
    else:
        return "Je n'ai pas bien compris..."


@app.route('/api/chatbot', methods=['POST'])
def chatbot_endpoint():
    data = request.get_json()
    user_message = data['message']
    is_question = is_question(user_message)
    if is_question:
        intent = detect_intent(question)
    #if intent == "question":
    #    extract = get_wikipedia_info(user_message)
    #if extract is not None :
    #    bot_response = extract
    else:
        bot_response = get_response(user_message)
        info_type = infer_information_type(user_message)
    if info_type:
        for intent in intents['intents']:
            if tag == intent['tag']:
                if info_type in intent['responses']:
                    bot_response = random.choice(intent['responses'][info_type])
                    break
    return jsonify({'response': bot_response})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

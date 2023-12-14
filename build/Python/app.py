from flask import Flask
from flask import jsonify, request
import random
import json
import torch
from langdetect import detect
from model import NeuralNet
from nltk_utils import bag_of_words, tokenize, is_question, detect_intent, is_request
import requests
import os

app = Flask(__name__)

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

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


    # blabla nltk
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

    # Appel a info type pour améliorer les réponses
    info_type = infer_information_type(user_message)

    # parsing message et génération réponse
    if prob.item() > 0.7:
        #if info_type:
        #    for intent in intents['intents']:
        #      if tag == intent["tag"]:
        #            if info_type in intent['responses']:
        #                return random.choice(intent['responses'][info_type])
        #else:
            for intent in intents['intents']:
                if tag == intent["tag"]:
                    return random.choice(intent['responses'])
    else:
        return "Je n'ai pas bien compris..."


@app.route('/api/chatbot', methods=['POST'])
def chatbot_endpoint():
    data = request.get_json()
    user_message = data['message']
    bot_name = data['bot_name']

    #is_question = is_question(user_message)
    # if is_question:
    #     intent = detect_intent(question)
    # #if intent == "question":
    # #    extract = get_wikipedia_info(user_message)
    # #if extract is not None :
    # #    bot_response = extract
    # else:
    bot_response = get_response(user_message, bot_name)
    return jsonify({'response': bot_response})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

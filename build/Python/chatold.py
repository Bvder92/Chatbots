import random
import json

import torch

from langdetect import detect
from model import NeuralNet
from nltk_utils import bag_of_words, tokenize

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

def get_wikipedia_info(query):
  # Effectuer une requête HTTP vers l'API Wikipédia
  response = requests.get("https://en.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&titles=" + query)

  # Vérifier si la requête a réussi
  if response.status_code == 200:
    # Récupérer les informations de la réponse
    data = response.json()
    extract = data["query"]["pages"][query]["extract"]
    return extract
  else:
    return None

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
    if prob.item() > 0.75:
        for intent in intents['intents']:
            if tag == intent["tag"]:
                return random.choice(intent['responses'])
    else:
        return "Je n'ai pas bien compris..."



print("Lançons une conversation ! (type 'quit' to exit)")
while True:
    # sentence = "do you use credit cards?"
    sentence = input("Vous: ")
    if sentence == "quit":
        break
    detected_language = detect(sentence)
    sentence = tokenize(sentence, language=detected_language)
    X = bag_of_words(sentence, all_words, language=detected_language)
    X = X.reshape(1, X.shape[0])
    X = torch.from_numpy(X).to(device)

    output = model(X)
    _, predicted = torch.max(output, dim=1)

    tag = tags[predicted.item()]

    probs = torch.softmax(output, dim=1)
    prob = probs[0][predicted.item()]
    info_type = infer_information_type(sentence)
    if prob.item() > 0.75:
        for intent in intents['intents']:
            if tag == intent["tag"]:
                print(f"{bot_name}: {random.choice(intent['responses'][info_type])}")
    else:
        print(f"{bot_name}: I do not understand...")




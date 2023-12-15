import random
import json
import spacy
import torch
import nltk 
from langdetect import detect
from model import NeuralNet
from nltk_utils import bag_of_words, tokenize
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import wikipediaapi

wiki_wiki = wiki_wiki = wikipediaapi.Wikipedia(
    language='fr',
    extract_format=wikipediaapi.ExtractFormat.WIKI,
    user_agent='my-application/1.0'
)
nlp = spacy.load("fr_core_news_sm")

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

with open('intents/cinema/intents.json', 'r') as json_data:
    intents = json.load(json_data)

FILE = "intents/cinema/data.pth"
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
    if not isinstance(input, str):
        input = str(input)  # Convert input to string if it's not already
    detected_language = detect(input)
    '''
    keywords = tokenize(input, language=detected_language)
    if not keywords:
        return None
    phrases = nltk.sent_tokenize(input)
    if not phrases: 
        return None
    '''
    doc = nlp(input)

    info_type_mapping = {
       "définition": ["qu'est-ce que", "qu'est-ce qu'", "qu'est", "c'est quoi"],
        "date": ["quand"],
        "lieu": ["où"],
        "personne": ["qui"],
        "raison": ["pourquoi"],
        "procédure": ["comment"]
    }

    '''
    for keyword in keywords:
        if keyword in info_type_mapping:
            info_type = info_type_mapping[keyword]
            break
    for phrase in phrases:
        if phrase.lower() in info_type_mapping:
            info_type = info_type_mapping[phrase.lower()]
            break
    return info_type
    '''
    for token in doc:
        for info_type, triggers in info_type_mapping.items():
            for trigger in triggers:
                if trigger in token.text.lower():
                    return info_type
    return None

vectorizer = TfidfVectorizer()

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

    tfidf = vectorizer.fit_transform(input)
    similarity = cosine_similarity(tfidf[-1], tfidf)
    index = similarity.argsort()[0][-2]
    max_similarity = similarity.flatten().max()

    if max_similarity > 0.3:
        if prob.item() > 0.75:
            for intent in intents['intents']:
                if tag == intent['tag']:
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
            if tag == intent['tag']:
                responses = intent['responses']
                if info_type is not None and info_type in responses:
                    response = random.choice(responses[info_type])
                else : 
                    response = random.choice(intent['responses'])
                print(f"{bot_name}: {response}")
    else:
        print(f"{bot_name}: Je ne comprends pas... Pouvez-vous reformuler ?")




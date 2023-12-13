'''
import nltk 
from nltk.stem import WordNetLemmatizer
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity 

import wikipedia


nltk.download('averaged_perceptron_tagger')
nltk.download('wordnet')
nltk.download('punkt')

wikipedia.set_lang("fr")
text = wikipedia.page('Mbappé').content

lemmatizer = WordNetLemmatizer()

def lemma_me(sent):
    sentence_tokens = nltk.word_tokenize(sent.lower())
    pos_tags = nltk.pos_tag(sentence_tokens)

    sentence_lemmas = []
    for token, pos_tag in zip(sentence_tokens, pos_tags):
        if pos_tag[1][0].lower() in ['n', 'v', 'a', 'r']:
            lemma = lemmatizer.lemmatize(token, pos_tag[1][0].lower())
            sentence_lemmas.append(lemma)

    return sentence_lemmas

def process(text, question):
    sentence_tokens = nltk.sent_tokenize(text)
    sentence_tokens.append(question)

    tv = TfidfVectorizer(tokenizer = lemma_me)
    tf = tv.fit_transform(sentence_tokens)
    values = cosine_similarity(tf[-1], tf)
    index = values.argsort()[0][-2]
    values_flat = values.flatten()
    values_flat.sort()
    coeff = values_flat[-2]
    if coeff > 0.3 :
        return sentence_tokens[index]


while True: 
    question = input("Hi, what do you want to know? \n")
    output = process(text, question)
    if output:
        print(output)
    elif question=='quit':
        break
    else: 
        print("I don't know...")

import spacy
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

import wikipedia

nlp = spacy.load("fr_core_news_sm")
wikipedia.set_lang("fr")
text = wikipedia.page('Mbappé').content

def process(text, question):
    doc = nlp(text)
    sentences = [sent.text for sent in doc.sents]
    sentences.append(question)

    vectorizer = TfidfVectorizer()
    tfidf = vectorizer.fit_transform(sentences)
    similarity = cosine_similarity(tfidf[-1], tfidf)
    index = similarity.argsort()[0][-2]
    max_similarity = similarity.flatten().max()

    if max_similarity > 0.3:
        return sentences[index]

while True:
    question = input("Bonjour, que souhaitez-vous savoir ? \n")
    output = process(text, question)
    if output:
        print(output)
    elif question == 'quit':
        break
    else:
        print("Je ne sais pas...")

'''
import spacy
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import wikipediaapi

wiki_wiki = wiki_wiki = wikipediaapi.Wikipedia(
    language='fr',
    extract_format=wikipediaapi.ExtractFormat.WIKI,
    user_agent='my-application/1.0'
)
nlp = spacy.load("fr_core_news_sm")


def process(entity, question):
    page = wiki_wiki.page(entity)
    if not page.exists():
        return "La page n'existe pas. Veuillez poser une autre question."

    text = page.summary
    doc = nlp(text)

    sentences = [sent.text for sent in doc.sents]
    sentences.append(question)

    vectorizer = TfidfVectorizer()
    tfidf = vectorizer.fit_transform(sentences)
    similarity = cosine_similarity(tfidf[-1], tfidf)
    index = similarity.argsort()[0][-2]
    max_similarity = similarity.flatten().max()

    if max_similarity > 0.3:
        return sentences[index]

while True:
    entity = input("De quel sujet voulez-vous en savoir plus ? \n")
    question = input("Quelle est votre question ? \n")
    output = process(entity, question)
    if output:
        print(output)
    elif entity.lower() == 'quit':
        break
    else:
        print("Je ne peux pas fournir de réponse à cette question.")

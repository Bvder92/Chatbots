import numpy as np
import nltk
nltk.download('punkt')
nltk.download('stopwords')
from nltk.stem.porter import PorterStemmer
from nltk.corpus import stopwords
import re

#optimiser la tokenisation des phrases en français
french_stopwords = set(stopwords.words('french'))
filtre_stopfr = lambda text: [token for token in text if token.lower() not in french_stopwords]



def tokenize(sentence, language='english'):
    """
    split sentence into array of words/tokens
    a token can be a word or punctuation character, or number
    """
    if language=="french":
        return filtre_stopfr(nltk.word_tokenize(sentence, language='french'))
    elif language == 'english':
        return nltk.word_tokenize(sentence, language='english')
    else:
        # Retourne la tokenization par défaut (anglaise) si la langue spécifiée n'est ni "French" ni "English"
        return nltk.word_tokenize(sentence, language="english")

def stem(word, language='english'):
    """
    stemming = find the root form of the word
    examples:
    words = ["organize", "organizes", "organizing"]
    words = [stem(w) for w in words]
    -> ["organ", "organ", "organ"]
    """
    if language =="french":
        stemmer = FrenchStemmer()
    elif language=="english":
        stemmer = PorterStemmer()
    else:
        stemmer = PorterStemmer()
    return stemmer.stem(word.lower())


def bag_of_words(tokenized_sentence, words, language="english"):
    """
    return bag of words array:
    1 for each known word that exists in the sentence, 0 otherwise
    example:
    sentence = ["hello", "how", "are", "you"]
    words = ["hi", "hello", "I", "you", "bye", "thank", "cool"]
    bog   = [  0 ,    1 ,    0 ,   1 ,    0 ,    0 ,      0]
    """
    # stem each word
    if language=="french":
        sentence_words = [stem(word, language="french") for word in tokenized_sentence]

    elif language=="english":
    # initialize bag with 0 for each word
        sentence_words = [stem(word, language="english") for word in tokenized_sentence]

    else :
        sentence_words = [stem(word, language="english") for word in tokenized_sentence]

    bag = np.zeros(len(words), dtype=np.float32)
    for idx, w in enumerate(words):
        if w in sentence_words:
            bag[idx] = 1

    return bag



#a = "Qu'est ce qui est jaune et qui attends ? Jonathan"
#print(a)
#a = tokenize(a)
#print(a)

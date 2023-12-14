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

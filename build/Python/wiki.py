import requests
import torch 

def is_question(sentence):
  question_words = ["est-ce que", "sais-tu", "connais-tu","as-tu", "quel", "qui", "où", "quand", "comment", "pourquoi", "quelle"]
  for word in question_words:
    if word in sentence:
      return True
  else:
    return False


def get_wikipedia_info(query):
    response = requests.get("https://fr.wikipedia.org/w/api.php?action=query&prop=extracts&format=json&titles="+query)

    if response.status_code == 200:
        data = response.json()
        print(data)
        page_id = next(iter(data["query"]["pages"]))
        '''
        extract = data["query"]["pages"][query][extract]
        text = re.sub(r"\[[^\]]+\]", "", extract)
        first_sentence = text.split(".")[0]
        return first_sentence
    else:
        return None
        '''
        if page_id != "-1":
            return data["query"]["pages"][pages_id]["extract"]
        else: 
            return f"Aucun article trouvé pour {query}."
    else :
        return f"Erreur lors de l'envoi de la requete http"
    
def chat(question):
    if is_question(question):
        extract = get_wikipedia_info(question)
        if extract is not None: 
            response = "La réponse est " + extract 
        else: 
            response = "Je ne suis pas sur de comprendre votre question"
    else:
        response = "Je suis désolé, je ne sais pas répondre à cette question"
    
    return response 


print(get_wikipedia_info("Paris"))


    
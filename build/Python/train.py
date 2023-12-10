import numpy as np
import random
import json
import nltk
import torch
import torch.nn as nn
from torch.utils.data import Dataset, DataLoader
from nltk.translate.bleu_score import sentence_bleu
from langdetect import detect
from nltk_utils import bag_of_words, tokenize, stem, is_question
from model import NeuralNet
#from transformers import pipeline

with open('intents.json', 'r') as f:
    intents = json.load(f)

all_words = []
tags = []
xy = []

def get_positive_examples(intents):
    positive_examples = []
    for intent in intents['intents']:
        for pattern in intent['patterns']:
            if is_question(pattern):
                positive_examples.append((pattern, intent['tag']))
    return positive_examples

def get_negative_examples(positive_examples):
    negative_examples = []
    for question, tag in positive_examples: 
        for _ in range(10):
            negative_example = generate_negative_example(question, all_words, tags)
            negative_examples.append(negative_example)
    return negative_examples

def generate_negative_example(question, all_words, tags):
    words = question.split()
    new_words = words.copy()
    random_index = random.randrange(len(words))
    new_words.pop(random_index)
    new_question = ' '.join(new_words)

    random_word = random.choice(all_words)
    new_question = new_question.split()
    new_question.insert(random_index, random_word)
    new_question = ' '.join(new_question)

    similarity = 0
    for positive_question, _ in positive_examples:
        current_similarity = sentence_bleu(positive_question, new_question)
        if current_similarity > similarity:
            similarity = current_similarity
        
    if similarity < 0.75:
        tag = random.choice(tags)
        return(new_question, tag)
    else:
        return False 


for intent in intents['intents']:
    tag = intent['tag']
    tags.append(tag)
    for pattern in intent['patterns']:
        # tokenize each word in the sentence
        detected_language = detect(pattern)
        w = tokenize(pattern, language=detected_language)
        # add to our words list
        all_words.extend(w)
        # add to xy pair
        xy.append((w, tag))

# stem and lower each word
ignore_words = ['?', '.', '!']
all_words = [stem(w) for w in all_words if w not in ignore_words]
# remove duplicates and sort
all_words = sorted(set(all_words))
tags = sorted(set(tags))

print(len(xy), "patterns")
print(len(tags), "tags:", tags)
print(len(all_words), "unique stemmed words:", all_words)

#with open('data_negative.json', 'r') as f:
#    negative_example = json.load(f)

#examples = positive_examples + negative_example

# create training data
X_train = []
y_train = []
for (pattern_sentence, tag) in xy:
    # X: bag of words for each pattern_sentence
    pattern_sentence_str = str(pattern_sentence)
    detected_language = detect(pattern_sentence_str)
    bag = bag_of_words(pattern_sentence, all_words, language=detected_language)
    X_train.append(bag)
    # y: PyTorch CrossEntropyLoss needs only class labels, not one-hot
    label = tags.index(tag)
    y_train.append(label)

X_train = np.array(X_train)
y_train = np.array(y_train)

# Hyper-parameters
num_epochs = 1000
batch_size = 8
learning_rate = 0.001
input_size = len(X_train[0])
hidden_size = 8
output_size = len(tags)
print(input_size, output_size)

class ChatDataset(Dataset):

    def __init__(self):
        self.n_samples = len(X_train)
        self.x_data = X_train
        self.y_data = y_train

    # support indexing such that dataset[i] can be used to get i-th sample
    def __getitem__(self, index):
        return self.x_data[index], self.y_data[index]

    # we can call len(dataset) to return the size
    def __len__(self):
        return self.n_samples

dataset = ChatDataset()
train_loader = DataLoader(dataset=dataset,
                          batch_size=batch_size,
                          shuffle=True,
                          num_workers=0)

device = torch.device('cuda' if torch.cuda.is_available() else 'cpu')

model = NeuralNet(input_size, hidden_size, output_size).to(device)

# Loss and optimizer
criterion = nn.CrossEntropyLoss()
optimizer = torch.optim.Adam(model.parameters(), lr=learning_rate)

# Train the model
for epoch in range(num_epochs):
    for (words, labels) in train_loader:
        words = words.to(device)
        labels = labels.to(dtype=torch.long).to(device)

        # Forward pass
        outputs = model(words)
        # if y would be one-hot, we must apply
        # labels = torch.max(labels, 1)[1]
        loss = criterion(outputs, labels)

        # Backward and optimize
        optimizer.zero_grad()
        loss.backward()
        optimizer.step()

    if (epoch+1) % 100 == 0:
        print (f'Epoch [{epoch+1}/{num_epochs}], Loss: {loss.item():.4f}')


print(f'final loss: {loss.item():.4f}')

data = {
"model_state": model.state_dict(),
"input_size": input_size,
"hidden_size": hidden_size,
"output_size": output_size,
"all_words": all_words,
"tags": tags
}
 
positive_examples = get_positive_examples(intents)
negative_examples = get_negative_examples(positive_examples)

    # Save the negative examples
with open('data_negative.json', 'w') as f:
    json.dump(negative_examples, f)

FILE = "data.pth"
torch.save(data, FILE)

print(f'Entrainement terminé. Modèle enregistré dans {FILE}')




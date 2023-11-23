FROM pytorch/pytorch

WORKDIR /usr/src/app

#ADD main.py .

RUN pip install --upgrade pip

RUN pip install nltk

RUN pip install transformers

COPY train.py .

COPY chat.py .

COPY intents.json .

COPY model.py .

COPY nltk_utils.py .

CMD ["python", "./train.py"]

CMD ["python", "./chat.py"]


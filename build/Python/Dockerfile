FROM pytorch/pytorch

WORKDIR /usr/src/app

#ADD main.py .

RUN pip install --upgrade pip

RUN pip install nltk

RUN pip install transformers

RUN pip install langdetect

RUN pip install flask

COPY train.py .

COPY intents.json .

COPY model.py .

COPY nltk_utils.py .

COPY app.py .

RUN python3 train.py

CMD ["python3", "app.py"]

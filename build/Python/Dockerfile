FROM pytorch/pytorch

WORKDIR /usr/src/app

#ADD main.py .

RUN pip install --upgrade pip

RUN pip install nltk

RUN pip install transformers

RUN pip install langdetect

RUN pip install flask

RUN pip install requests

Run pip install wikipedia

Run pip install wikipedia-api

RUN pip install scikit-learn

Run pip install spacy

RUN python -m spacy download fr_core_news_sm

#COPY train.py .

#COPY intents.json .

COPY model.py .

COPY nltk_utils.py .

#COPY app.py .

COPY wiki2.py .

#COPY chatold.py .
#RUN python3 train.py

#CMD ["python3", "app.py"]

CMD ["python3", "wiki2.py"]


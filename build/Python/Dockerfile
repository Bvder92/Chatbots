FROM pytorch/pytorch

WORKDIR /usr/src/app

RUN pip install --upgrade pip

RUN pip install nltk

RUN pip install transformers

RUN pip install langdetect

RUN pip install flask

RUN pip install requests

RUN pip install scikit-learn

RUN pip install spacy

RUN python -m spacy download fr_core_news_sm

COPY train.py .

COPY intents ./intents/

COPY model.py .

COPY nltk_utils.py .

COPY app.py .

RUN python3 train.py principal

RUN python3 train.py gamer

RUN python3 train.py cinema

RUN python3 train.py manga

RUN python3 train.py ecoloGPT

RUN python3 train.py foot

CMD ["python3", "app.py"]

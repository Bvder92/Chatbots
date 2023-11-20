FROM python:3

WORKDIR /usr/src/app

#ADD main.py .

RUN pip install --upgrade pip

RUN pip install --no-cache-dir chatterbot==1.0.5

COPY main.py .

CMD ["python", "./main.py"]

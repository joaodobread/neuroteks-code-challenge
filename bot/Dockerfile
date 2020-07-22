FROM python:alpine

# instalar o pipenv
RUN pip install pipenv

WORKDIR /app

COPY . /app

# instala as dependencia na máquina

RUN pipenv lock --requirements > requirements.txt
RUN pip install -r requirements.txt
# RUN rm requirements.txt

CMD [ "flask", "run" ]
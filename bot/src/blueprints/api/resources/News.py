from flask_restful import Resource
import requests
import json
from ..bot.news_crawler import UolCrawler


class News(Resource):
    def get(self):
        response = requests.get("http://php/news")
        news = json.loads(response.text)

        titles = list()

        for new in news:
            titles.append(new["title"])

        uol = UolCrawler().run()

        response = [new for new in uol if new["title"]
                    not in titles and new["content"] != ""]
        response = response[:5]
        return response

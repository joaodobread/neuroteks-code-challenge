from bs4 import BeautifulSoup
import requests
import json
import re

classNames = [
    "c-news__content",
    "special-text",
    "text"
]


class New:
    def __init__(self, title="", thumb="", link=""):
        self.title = title
        self.link = link
        self.image = thumb
        self.content = ""


class UolCrawler:
    def __init__(self):
        self.base_url = "https://www.uol.com.br/"
        self.home_page = ""
        self.news: New = []

    def make_request(self, url):
        response = requests.get(url)
        text = ""

        if response.status_code == 200:
            text = response.text

        return text

    def parser(self, html: str) -> BeautifulSoup:
        return BeautifulSoup(html, "html.parser")

    def get_home_news(self) -> []:
        home_page_parsed = self.parser(self.home_page)

        # cada card de noticia é uma div.submanchete-col
        # logo submanchete_cols são as noticias principais
        submanchete_cols = home_page_parsed.find_all(
            "div", {"class": lambda className: className in ["submanchete-col"]})

        return submanchete_cols

    def home_page_news_to_class(self, news: list):
        """
            Gera uma lista de New contendo os valores necessários
            para gerar buscar as informações das noticias no site da uol
        """
        for new in news:
            new: BeautifulSoup = new

            link = str(new.find("a")["href"]) if new.find("a") != None else ""
            thumb = str(new.find("img")[
                "data-src"]) if new.find("img") != None else ""
            title = str(new.find("h2").text) if new.find("h2") != None else ""

            manchete = New(link=link, thumb=thumb, title=title)
            self.news.append(manchete)

    def run(self):
        self.home_page = self.make_request(self.base_url)
        home_page_news = self.get_home_news()

        self.home_page_news_to_class(home_page_news)
        self.get_new_content()

        json_ret = []

        for new in self.news:
            json_ret.append(new.__dict__)

        return json_ret

    def get_new_content(self):
        """
            Percorre a lista de noticias para buscar o corpo da noticia em si
        """
        for new in self.news:
            response = self.make_request(new.link)
            soup = self.parser(response)

            # pega todoas as divs onde tem classes que podem ser de noticias
            content = soup.find_all(
                "div", {"class": lambda className: className in classNames})

            content_str = "".join([str(item) for item in content])
            new.content = self.normalize_text(content_str)

    def normalize_text(self, html: str) -> str:
        p = re.compile(r"<.*?>")
        text = p.sub("", html)
        text = text.replace('\n', '').replace('\r', '')
        text.rstrip()
        return text


if __name__ == "__main__":
    UolCrawler().run()

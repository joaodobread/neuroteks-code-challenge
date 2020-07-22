from flask import Flask, Blueprint
from flask_restful import Api

from .resources.News import News


app_bp = Blueprint(__name__, "api", url_prefix="/api/v1")
api = Api(app_bp)

api.add_resource(News, "/news")


def init_app(app: Flask):
    app.register_blueprint(app_bp)

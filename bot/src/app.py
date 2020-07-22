from flask import Flask
from .blueprints.api import api
from .blueprints import cors


def create_app() -> Flask:
    app = Flask(__name__)
    cors.init_app(app)
    api.init_app(app)

    return app

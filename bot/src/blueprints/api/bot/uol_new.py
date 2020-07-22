class UolNew:
    def __init__(self, title="", thumb_image="", new_link="", content=""):
        self.title = title
        self.thumb_image = thumb_image
        self.content = content
        self.new_link = new_link
        self._from = __name__

    def __str__(self):
        return f"<Instance of {__name__}: {self.title} \n {self.thumb_image} \n {self.content} \n {self.new_link} \n {self._from} "

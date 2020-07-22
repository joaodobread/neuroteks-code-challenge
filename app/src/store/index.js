import Vue from "vue";
import Vuex from "vuex";

import { botApi, newsApi } from "@/services";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    news: {
      headlines: [],
      loading: true,
      error: null
    },
    readNews: {
      headline: {},
      loading: true,
      error: null
    }
  },

  mutations: {
    LOAD_ALL_NEWS_START({ news }) {
      news.loading = true;
      news.error = false;
    },
    LOAD_ALL_NEWS_SUCCESS({ news }, payload) {
      news.loading = false;
      news.headlines = payload;
    },
    LOAD_ALL_NEWS_ERROR({ news }, payload) {
      news.loading = false;
      news.error = payload;
      news.headlines = [];
    },
    LOAD_ONE_NEW_START({ readNews }) {
      readNews.loading = true;
      readNews.error = false;
    },
    LOAD_ONE_NEW_SUCCESS({ readNews }, payload) {
      readNews.loading = false;
      readNews.headline = payload;
    },
    LOAD_ONE_NEW_ERROR({ readNews }) {
      readNews.loading = false;
      readNews.error = true;
      readNews.headline = null;
    }
  },
  actions: {
    async loadAllNews() {
      this.commit("LOAD_ALL_NEWS_START");

      let response = await botApi.get("/news");

      if (response.data) {
        let news = response.data.map(headline => {
          let form = new FormData();
          form.append("title", headline.title);
          form.append("image", headline.image);
          form.append("text", headline.content);
          return form;
        });

        news.map(headline => newsApi.post("/news", headline));
      }
      let news_response = await newsApi.get("/news");

      this.commit("LOAD_ALL_NEWS_SUCCESS", news_response.data);
    },

    async loadOneNew(context, id) {
      this.commit("LOAD_ONE_NEW_START");
      let response = await newsApi.get("/news/one", {
        params: {
          id
        }
      });

      if (response.data.id) this.commit("LOAD_ONE_NEW_SUCCESS", response.data);
      else this.commit("LOAD_ONE_NEW_ERROR");
    },

    async editNew(context, headline) {
      let form = new FormData();

      form.append("id", headline.id);
      form.append("title", headline.title);
      form.append("image", headline.image);
      form.append("text", headline.text);

      console.log(headline);
      let r = await newsApi.put("/news", form, {
        headers: { "Access-Control-Allow-Origin": "*" },
        crossdomain: true
      });
      console.log(r);
    }
  },
  modules: {}
});

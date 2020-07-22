<template>
  <div class="home">
    <div v-if="news.loading">
      <div class="text-center">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </div>
    </div>
    <div v-else>
      <v-row>
        <div class="ml-2">
          <v-btn @click="reload"> Recarregar</v-btn>
        </div>
      </v-row>
      <v-row>
        <v-col cols="3" v-for="item of news.headlines" :key="item.id">
          <HeadlineCard :headline="item" />
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src

import { mapState } from "vuex";
import HeadlineCard from "@/components/HeadlineCard";
export default {
  name: "home",
  mounted() {
    this.$store.dispatch("loadAllNews");
  },
  computed: {
    ...mapState(["news"])
  },
  components: {
    HeadlineCard
  },
  methods: {
    reload() {
      this.$store.dispatch("loadAllNews");
    }
  }
};
</script>

<style lang="scss" scoped>
.ml-2 {
  margin-left: 10px;
}
</style>

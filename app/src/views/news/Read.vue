<template>
  <div class="">
    <div v-if="readNews.loading">
      <div class="text-center">
        <v-progress-circular
          indeterminate
          color="primary"
        ></v-progress-circular>
      </div>
    </div>

    <div v-if="readNews.error">
      <h1>Tivemos um pequeno erro.</h1>
    </div>

    <div v-else>
      <v-row>
        <v-col>
          <router-link :to="{ name: 'Home' }">
            <v-btn>Voltar</v-btn>
          </router-link>
          <router-link
            :to="{ name: 'Edit', params: { id: readNews.headline.id } }"
          >
            <v-btn class="ml-2">Editar</v-btn>
          </router-link>
        </v-col>
      </v-row>
      <div class="text-center">
        <v-parallax dark :src="readNews.headline.image">
          <v-row align="center" justify="center">
            <v-col class="text-center" cols="12">
              <h4 class="subheading">{{ readNews.headline.title }}</h4>
            </v-col>
          </v-row>
        </v-parallax>
        <v-divider />
        <div class="text-justify container">
          {{ readNews.headline.text }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState(["readNews"])
  },
  mounted() {
    this.$store.dispatch("loadOneNew", this.$route.params.id);
  }
};
</script>

<style>
.ml-2 {
  margin-left: 10px;
}
</style>

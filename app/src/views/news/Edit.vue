<template>
  <v-container>
    <v-text-field
      v-model="newsToEdit.title"
      :counter="10"
      label="Título"
      required
    ></v-text-field>

    <v-text-field
      v-model="newsToEdit.image"
      :counter="10"
      label="Link da imagem"
      required
    ></v-text-field>

    <v-textarea
      filled
      name="input-7-4"
      label="Notícia completa"
      :value="newsToEdit.text"
    ></v-textarea>

    <div class="divider"></div>

    <v-btn @click="save">Salvar</v-btn>
  </v-container>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["readNews"]),
    newsToEdit() {
      return this.readNews.headline;
    }
  },
  mounted() {
    this.$store.dispatch("loadOneNew", this.$route.params.id);
  },
  methods: {
    save() {
      this.$store.dispatch("editNew", this.newsToEdit);
    }
  }
};
</script>

<style></style>

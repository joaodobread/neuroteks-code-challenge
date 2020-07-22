<template>
  <v-card max-width="400">
    <v-img class="white--text align-end" height="200px" :src="headline.image">
      <v-card-title>{{ headline.title }}</v-card-title>
    </v-img>

    <v-card-actions>
      <router-link :to="{ name: 'Read', params: { id: headline.id } }">
        <v-btn color="orange" text>
          Informações
        </v-btn>
      </router-link>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  props: {
    headline: {
      title: "Title",
      image: "https://cdn.vuetifyjs.com/images/cards/docks.jpg",
      from: "",
      content: ""
    }
  }
};
</script>

<style></style>v

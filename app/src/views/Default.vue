<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list dense>
        <router-link :to="{ name: 'News' }" class="link">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>more</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Notícias</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>

        <router-link :to="{ name: 'About', path: 'about' }" class="link">
          <v-list-item link>
            <v-list-item-action>
              <v-icon>info</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Sobre</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="indigo" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null
  })
};
</script>

<style lang="scss" scoped>
.link {
  color: rgba($color: #000000, $alpha: 0.7);
  text-decoration: none;
}
</style>

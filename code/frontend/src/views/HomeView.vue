<script>

import QuestionComponent from "@/components/QuestionComponent.vue";
import HeroComponent from "@/components/HeroComponent.vue";
export default {
  name: "HomeView",
  components: {
    HeroComponent,
    QuestionComponent,
  },
};

</script>

<template>
  <v-container>
    <v-row>
      <v-col cols="4">
        <HeroComponent />
      </v-col>
      <v-col cols="8">
        <QuestionComponent />
      </v-col>
    </v-row>
  </v-container>

</template>

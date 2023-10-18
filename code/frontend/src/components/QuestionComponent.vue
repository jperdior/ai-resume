<script>
import axios from 'axios'
export default {
  name: 'QuestionComponent',
  data() {
    return {
      question: '',
      questions: [],
      answers: [],
      answer: null,
      error: false,
      message: null,
      loading: false
    }
  },
  methods: {
    async askQuestion() {
      this.loading = true;
      try{
        const response = await axios.post('/question', {
          question: this.question,
        });
        this.questions.push(this.question);
        this.answers.push(response.data.answer);
        this.question = '';
      }
      catch(error){
        this.message = error.response.data.message;
        this.error = true;
      }
      this.loading = false;

    }
  }


}

</script>

<template>
  <v-overlay v-model="loading">
    <v-progress-circular indeterminate size="64"></v-progress-circular>
  </v-overlay>
  <v-dialog v-model="error">
    <v-card>
      <v-card-title>An error occurred:</v-card-title>
      <v-card-text>{{ message }}</v-card-text>
    </v-card>
  </v-dialog>
  <v-container fluid>
    <v-row>
      <v-col>
        <v-form @submit.prevent="askQuestion">
          <v-text-field
              v-model="question"
              label="Ask a question"
              placeholder="Ask something about me. For example: What sports do you like? Are you an expert in DDD?"
              required
          >
          </v-text-field>
          <v-btn type="submit" color="primary">Ask</v-btn>
        </v-form>
      </v-col>
    </v-row>
    <v-row v-if="answers.length > 0">
      <v-col>
        <v-card v-for="(qa, index) in questions" :key="index">
          <v-card-title>Answer to the question: <strong>{{ qa }}</strong></v-card-title>
          <v-card-text>{{ answers[index] }}</v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
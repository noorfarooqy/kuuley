<template>
  <div class="maths-div">
    <error-component v-for="(error, ekey) in errors" v-bind="{error_text:error }" :key="ekey"></error-component>
    <div>
      <formula-icons v-bind="{ Signs:Signs, element: getEditorElement(false)}"></formula-icons>
      <div class="form-group mb-3">
        <label class="control-label h6">New Question:</label>
        <textarea
          placeholder="Question text"
          ref="formula"
          v-model="QuizQuestion.question_text"
          type="text"
          name="question[title]"
          class="form-control"
        ></textarea>
      </div>
      <vue-mathjax :formula="GetMathsPreview()"></vue-mathjax>
      <div class="flex" v-if="type == 1">
        <label for="subscribe">Select if answer is true</label>
        <br />
        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
          <input
            v-if="QuizQuestion.answer"
            checked
            type="checkbox"
            id="subscribe"
            class="custom-control-input"
            @change="UpdateAnswers($event)"
          />
          <input
            v-else
            type="checkbox"
            id="subscribe"
            class="custom-control-input"
            @change="UpdateAnswers($event)"
          />
          <label class="custom-control-label" for="subscribe">True</label>
        </div>
        <label for="subscribe" class="mb-0">True</label>
      </div>
    </div>
    <div v-if="type == 2 || type == 3">
      <div class>
        <formula-icons v-bind="{Signs:Signs, answer:false, element: getEditorElement(true)}"></formula-icons>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-8">
          <label class="control-label h6">New Answer:</label>
          <input
            placeholder="Answer"
            ref="formula_answer"
            v-model="formula_answer"
            type="text"
            name="answer"
            class="form-control"
          />
        </div>
        <div class="col-md-4 col-lg-4">
          <label for="control-label h6">-</label>
          <button class="btn btn-primary form-control" @click.prevent="RecordAnswer()">Add answer</button>
        </div>
      </div>
      <div class="mt-3 mb-3">
        <vue-mathjax :formula="AddAnswerFormula()"></vue-mathjax>
      </div>
      <ul class="list-group" id="answer_container_1">
        <li
          class="list-group-item d-flex"
          data-position="1"
          data-answer-id="1"
          data-question-id="1"
          v-for="(answer, akey) in QuizQuestion.answers"
          :key="akey"
        >
          <span class="mr-2">
            <i class="fa fa-check-circle" style="color:green" v-if="answer.is_correct"></i>
            <i class="fa fa-times-circle" style="color:red" v-else></i>
          </span>
          <div>
            <vue-mathjax :formula="'$$ '+answer.answer+' $$'"></vue-mathjax>
          </div>
          <div class="ml-auto" v-if="type == 2">
            <input
              :checked="answer.is_correct"
              type="radio"
              name="question[correct_answer_id]"
              id="correct_answer_6"
              @click="UpdateAnswers(answer)"
            />
            <i
              class="fa fa-trash-alt fa-1x ml-2"
              style="cursor:pointer;color:red"
              @click="DeleteAnswer(answer)"
            ></i>
          </div>
          <div class="ml-auto" v-else>
            <input
              :checked="answer.is_correct"
              type="checkbox"
              :name="'correct_answer'+akey"
              value="answer.answer"
              id="correct_answer_6"
              @click="UpdateAnswers(answer)"
            />
            <i
              class="fa fa-trash-alt fa-1x ml-2"
              style="cursor:pointer;color:red"
              @click="DeleteAnswer(answer)"
            ></i>
          </div>
        </li>
      </ul>
    </div>
    <div class="form-group">
      <label for="relatedTopic" class="label">Related topic*</label>
      <select
        name="relatedTopic"
        id
        class="form-control"
        v-model="QuizQuestion.related_topic"
        @change.prevent="GetCourseLessons($event)"
      >
        <option value="-1" selected>Select related topics</option>
        <option
          :value="course.id"
          v-for="(course , ckey) in courses"
          :key="ckey"
        >{{course.course_name}}</option>
      </select>
    </div>
    <div class="form-group" v-if="lessons != null">
      <label for="relatedTopic" class="label">Related Lesson</label>
      <select name="relatedTopic" id class="form-control" v-model="QuizQuestion.related_lesson">
        <option value="-1" selected>Select related lessons</option>
        <option
          :value="lesson.id"
          v-for="(lesson , lkey) in lessons"
          :key="lkey"
        >{{lesson.lessonTitle}}</option>
      </select>
    </div>
    <button class="btn btn-primary mt-3" @click.prevent="SubmitQuestion()">
      <i class="material-icons">add</i>Create Question
    </button>
  </div>
</template>

<script>
import { VueMathjax } from "vue-mathjax";
import signs from "../quizes/signs";
import SingleChoiceQuiz from "../quizes/single_choice_question";
import TrueFalseQuiz from "../quizes/true_false_question";
import MultiChoiceQuiz from "../quizes/multi_choice_question";
import formulaIcons from "../components/formula_icons.vue";
import error from "../components/error.vue";
import ErrorsText from ".././ErrorsText";
import Server from "./../server";
export default {
  data() {
    return {
      name: "maths-vue",
      version: "1.0",
      formula: "",
      formula_answer: "",
      ForumalErrors: new ErrorsText().Formula,
      errors: [],
      Signs: new signs(),
      Server: new Server(),
      QuizQuestion:
        this.type == 1
          ? new TrueFalseQuiz()
          : this.type == 2
          ? new SingleChoiceQuiz()
          : new MultiChoiceQuiz()
    };
  },
  mounted() {
    this.$emit("get-course-list");
  },

  methods: {
    GetMathsPreview() {
      return "$$ " + this.QuizQuestion.question_text + " $$";
    },
    AddAnswerFormula() {
      return "$$" + this.formula_answer + "$$";
    },
    RecordAnswer() {
      this.errors = [];
      if (
        this.QuizQuestion.question_text != null &&
        this.QuizQuestion.question_text.length >= 3
      ) {
        this.QuizQuestion.NewAnswer(this.formula_answer);
        this.formula_answer = "";
      } else this.errors.push(this.ForumalErrors.formula_incomplete);
    },
    getEditorElement(answer = false) {
      if (answer) {
        console.log("for asnwer ");
        return this.$refs.formula_answer;
      } else {
        console.log("for qeustion ");
        return this.$refs.formula;
      }
    },
    GetCourseLessons(event) {
      console.log("event event ", event);
      var options = event.target;
      var selectedIndex = options.selectedIndex;
      this.$emit("get-course-lessons", options.options[selectedIndex].value);
    },
    UpdateAnswers(answer) {
      this.QuizQuestion.UpdateAnswers(answer);
    },
    DeleteAnswer(answer) {
      this.QuizQuestion.DeleteAnswer(answer);
    },
    ShowQuizQuestions(data) {
      console.log(data);
    },
    showErrors(error) {
      // alert(error);
      console.log("error ", error);
      this.errors.push(error);
      var alertor = document.querySelector("div.error-alert-toast");
      console.log(
        "laertor ",
        $(alertor)
          .children("div.toast-danger")
          .children("div.toast-message")
      );
      $(alertor).css("display", "block");
      $(alertor)
        .children("div.toast-danger")
        .children("div.toast-message")
        .text(error);
      setTimeout(function() {
        $(alertor).css("display", "none");
      }, 10000);
      this.ToggleLoader();
    },

    ToggleLoader(status) {
      var loader = document.querySelector("div#modal-success");
      var toggle;
      if (status == null || status == false) toggle = "none";
      else toggle = "block";
      $(loader).css("display", toggle);
    },
    SubmitQuestion() {
      this.errors = [];
      this.ToggleLoader(true);
      if (this.QuizQuestion.QuestionIsValid(this.ForumalErrors)) {
        this.Server.setRequest({
          question_type: this.type,
          question_text: this.QuizQuestion.question_text,
          answers: this.QuizQuestion.answers,
          related_topic: this.QuizQuestion.related_topic,
          related_lesson: this.QuizQuestion.related_lesson,
          quiz_id: window.quiz_id,
          api_token: window.api_token
        });
        this.Server.serverRequest(
          "/api/admin/quiz/new",
          this.QuestionAdded,
          this.showErrors
        );
      } else this.showErrors(this.QuizQuestion.GetErrorMessage());
    },
    QuestionAdded(data) {
      // this.Questions.push(data);
      this.$emit("new-quiz-added", data);
      alert("New question has been added successfully");
      this.ToggleLoader();
    }
  },
  components: {
    "vue-mathjax": VueMathjax,
    "formula-icons": formulaIcons,
    "error-component": error
  },
  props: ["type", "courses", "lessons"]
};
</script>

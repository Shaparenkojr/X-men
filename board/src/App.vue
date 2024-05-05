<template>
  <div>
    <h1>Доски</h1>
    <router-link to="/register">Регистрация</router-link>
    <router-link to="/login">Вход</router-link>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App'
};
</script>

<!-- <template>
  <img alt="Vue logo" src="./assets/logo.png">
  <HelloWorld msg="Welcome to Your Vue.js App"/>
  <div id="app">
    <RegistrationForm />
    <LoginForm />
  </div>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      username: '',
      password: '',
      showPassword: false,
      login: '',
      rememberMe: false,
    };
  },
  methods: {
    registerUser() {
      // Логика регистрации пользователя
      const userData = {
        email: this.email,
        username: this.username,
        password: this.password,
      };
      console.log(userData); // Отправка данных на сервер
    },
    loginUser() {
      // Логика входа пользователя
      const loginData = {
        login: this.login,
        password: this.password,
        rememberMe: this.rememberMe,
      };
      console.log(loginData); // Отправка данных на сервер
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
  },
};
</script> -->

<!-- <template>
  <div id="app">
    <button @click="showLoginModal" class="btn btn-primary">Войти</button>
    <button @click="showRegistrationModal" class="btn btn-success">Зарегистрироваться</button>
    <b-modal v-model="showLogin" title="Вход" @hide="resetForms">
      <LoginForm />
    </b-modal>
    <b-modal v-model="showRegistration" title="Регистрация" @hide="resetForms">
      <RegistrationForm />
    </b-modal>
  </div>
</template>

<script>
import { ref } from 'vue';
import LoginForm from './components/LoginForm.vue';
import RegistrationForm from './components/RegistrationForm.vue';

export default {
  components: {
    LoginForm,
    RegistrationForm,
  },
  setup() {
    const showLogin = ref(false);
    const showRegistration = ref(false);

    const showLoginModal = () => {
      showLogin.value = true;
    };
    const showRegistrationModal = () => {
      showRegistration.value = true;
    };
    const resetForms = () => {
      showLogin.value = false;
      showRegistration.value = false;
    };

    return {
      showLogin,
      showRegistration,
      showLoginModal,
      showRegistrationModal,
      resetForms,
    };
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style> -->

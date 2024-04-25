<template>
  <div class="form-container">
    <div class="form-header">Вход</div>
    <form @submit.prevent="loginUser" class="form">
      <div class="form-group">
        <label for="login">Логин или E-mail</label>
        <input type="text" id="login" v-model="login" required>
      </div>
      <div class="form-group">
        <label for="password">Пароль</label>
        <div class="password-input">
          <input :type="showPassword ? 'text' : 'password'" id="password" v-model="password" required>
          <div class="password-icon" @click="toggleShowPassword">
            <img v-if="!showPassword" src="../icons/visibility.svg" alt="Показать пароль" class="icon">
            <img v-if="showPassword" src="../icons/visibility_off.svg" alt="Скрыть пароль" class="icon">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="rememberMe" class="checkbox-label">
          <input type="checkbox" id="rememberMe" v-model="rememberMe">
          Запомнить меня
        </label>
      </div>
      <button type="submit">Войти</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      login: '',
      password: '',
      showPassword: false,
      rememberMe: false
    };
  },
  methods: {
    async loginUser() {
      try {
        // console.log(this.form)
        const response = await fetch('https://localhost/X-men/back/login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.form)
        })
        console.log(response.json())
        //смотрим ответ, если нужно
        // const answer = await response.json();
        // console.log(answer);
      } catch (err) {
        console.error('Ошибка:', err);
      }
    },
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    }
  }
};
</script>

<style>
.form-container {
  width: 100%;
  max-width: 500px;
  /* Увеличим ширину формы */
  margin: 0 auto;
  padding: 20px;
  border-radius: 16px;
  background-color: #D9D9D9;
}

.form-header {
  text-align: center;
  color: #032A4E;
  font-size: 24px;
  font-family: Inter, sans-serif;
  font-weight: 700;
  margin-bottom: 20px;
}

.form {
  display: flex;
  flex-direction: column;
}

.form-group {
  margin-bottom: 15px;
}

label {
  color: black;
  font-size: 18px;
  font-family: Inter, sans-serif;
  font-weight: 600;
  margin-bottom: 5px;
  display: block;
}

input {
  width: 100%;
  height: 40px;
  border-radius: 16px;
  border: 2px solid #032A4E;
  padding: 0 40px 0 10px;
  font-size: 16px;
  font-family: Inter, sans-serif;
  box-sizing: border-box;
}

.password-input {
  position: relative;
}

.password-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
}

.icon {
  width: 24px;
  height: auto;
  position: relative;
  top: 4px;
}

.checkbox-label {
  display: flex;
  align-items: center;
  font-size: 18px;
  /* Уменьшаем размер текста для метки "Запомнить меня" */
  font-family: Inter, sans-serif;
  font-weight: 600;
  margin-top: 10px;
  /* Небольшой отступ сверху для выравнивания по вертикали */
}

.checkbox-label input {
  margin-right: 8px;
  /* Увеличиваем отступ между чекбоксом и текстом */
  height: 18px;
  /* Увеличиваем высоту чекбокса */
  width: 18px;
  /* Увеличиваем ширину чекбокса */
}

button {
  width: 100%;
  height: 60px;
  background-color: #F4AE5B;
  color: white;
  font-size: 24px;
  font-family: Inter, sans-serif;
  font-weight: 600;
  border-radius: 16px;
  cursor: pointer;
  margin-top: 20px;
  border: none;
}
</style>

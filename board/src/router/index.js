import { createRouter, createWebHistory } from 'vue-router';
import LoginForm from '@/components/LoginForm.vue';
import RegistrationForm from '@/components/RegistrationForm.vue';
import BoardPage from '@/components/BoardPage.vue';

const routes = [
  {
    path: '/',
    redirect: '/login'
  },
  {
    path: '/login',
    component: LoginForm
  },
  {
    path: '/register',
    component: RegistrationForm
  },
  {
    path: '/board',
    component: BoardPage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;


// import { createRouter, createWebHistory } from 'vue-router';
// import RegistrationForm from '@/components/RegistrationForm.vue';
// import LoginForm from '@/components/LoginForm.vue';
// import BoardPage from '@/components/BoardPage.vue';

// const router = createRouter({
//   history: createWebHistory(),
//   routes: [
//     { path: '/register', component: RegistrationForm },
//     { path: '/login', component: LoginForm },
//     { path: '/board', component: BoardPage },
//     // Убираем маршрут для компонента App.vue
//     // { path: '/', component: App },
//     { path: '/', redirect: '/login' }, // Перенаправление на страницу входа по умолчанию
//   ],
// });

// export default router;
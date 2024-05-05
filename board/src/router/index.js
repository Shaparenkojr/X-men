import { createRouter, createWebHistory } from 'vue-router';
import RegistrationForm from '@/components/RegistrationForm.vue';
import LoginForm from '@/components/LoginForm.vue';

const routes = [
  { path: '/register', component: RegistrationForm },
  { path: '/login', component: LoginForm }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;

// import { createRouter, createWebHistory } from 'vue-router';
// import LoginForm from '../components/LoginForm.vue';
// import RegistrationForm from '../components/RegistrationForm.vue';

// const routes = [
//   { path: '/', redirect: '/login' }, // Перенаправление на форму входа по умолчанию
//   { path: '/login', component: LoginForm },
//   { path: '/registration', component: RegistrationForm },
// ];

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
// });

// export default router;

// import { createRouter, createWebHistory } from 'vue-router';
// import Home from '../views/Home.vue';

// const routes = [
//   {
//     path: '/',
//     name: 'Home',
//     component: Home,
//   },
// ];

// const router = createRouter({
//   history: createWebHistory(),
//   routes,
// });

// export default router;

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
    name: 'BoardPage',
    component: BoardPage,
    meta: { requiresAuth: true },
<<<<<<< HEAD
    props: ({ userId: localStorage.getItem('userid') })
=======
    props: true // Добавлено props: true для передачи параметров как пропсов
>>>>>>> 81e533cecec561b533b267be522fec6f26413a97
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
<<<<<<< HEAD
    const userId = localStorage.getItem('userid');
    if (!userId) {
=======
    // Если пользователь не аутентифицирован, перенаправляем его на страницу входа
    if (!localStorage.getItem('userid')) {
>>>>>>> 81e533cecec561b533b267be522fec6f26413a97
      next('/login');
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;

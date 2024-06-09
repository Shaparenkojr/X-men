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
    meta: { requiresAuth: true } // Добавляем мета-информацию, чтобы защитить этот маршрут
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Добавляем глобальную навигацию для защиты маршрутов
router.beforeEach((to, from, next) => {
  // Проверяем, требует ли маршрут аутентификации
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Если пользователь не аутентифицирован, перенаправляем его на страницу входа
    if (!localStorage.getItem('token')) {
      next('/login');
    } else {
      next(); // Продолжаем навигацию
    }
  } else {
    next(); // Продолжаем навигацию для остальных маршрутов
  }
});

export default router;


// import { createRouter, createWebHistory } from 'vue-router';
// import LoginForm from '@/components/LoginForm.vue';
// import RegistrationForm from '@/components/RegistrationForm.vue';
// import BoardPage from '@/components/BoardPage.vue';

// const routes = [
//   {
//     path: '/',
//     redirect: '/login'
//   },
//   {
//     path: '/login',
//     component: LoginForm
//   },
//   {
//     path: '/register',
//     component: RegistrationForm
//   },
//   {
//     path: '/board',
//     component: BoardPage
//   }
// ];

// const router = createRouter({
//   history: createWebHistory(),
//   routes
// });

// export default router;

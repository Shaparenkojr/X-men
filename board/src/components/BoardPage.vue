<template>
  <div class="board-page">
    <div class="board-header">
      <div class="fixed-bar">
        <div class="board-controls">
          <button @click="createColumn" class="create-column-btn">Создать колонку</button>
          <button @click="toggleEditMode" class="edit-columns-btn">
            {{ isEditMode ? 'Сохранить порядок' : 'Изменить порядок' }}
          </button>
        </div>
        <div class="user-info">
          <div class="user-details">
            <div class="user-name">{{ loggedInUser }}</div>
            <img src="../icons/logout.svg" alt="Logout" class="logout-icon" @click="logout">
          </div>
        </div>
      </div>
    </div>
    <draggable v-model="columns" :disabled="!isEditMode" @end="updateOrder" group="columns" class="board-columns">
      <template #item="{ element, index }">
        <TaskColumn :key="element.id" :column="element" :index="index" @updateColumn="updateColumn(index, $event)"
          @deleteColumn="deleteColumn(index)" @updateCards="updateCards(index, $event)"
          @changeColumnColor="changeColumnColor(index, $event)" />
      </template>
    </draggable>
  </div>
</template>

<script>
import TaskColumn from './TaskColumn.vue';
import draggable from 'vuedraggable';

export default {
  name: 'BoardPage',
  components: {
    TaskColumn,
    draggable,
  },
  data() {
    return {
      columns: [],
      isEditMode: false,
      loggedInUser: null, // Изменили инициализацию на null, чтобы правильно обработать загрузку данных пользователя
    };
  },
  async created() {
    await this.fetchUserData(); // Вызываем метод получения данных о пользователе при создании компонента
    console.log(this.loggedInUser);
    await this.fetchColumns();
  },
  methods: {
    async fetchColumns() {
      try {
        const response = await fetch('http://localhost/X-men/back/get_columns.php');
        const data = await response.json();
        this.columns = data;
      } catch (err) {
        console.error('Ошибка:', err);
      }
    },
    async createColumn() {
      // Проверяем, что у нас есть идентификатор текущего пользователя
      if (!this.loggedInUser) {
        console.error('Ошибка: не удалось получить идентификатор пользователя.');
        return;
      }

      // Подготавливаем данные для создания новой колонки
      const newColumn = {
        column_name: 'New Column', // Название колонки
        user_id: this.loggedInUser, // Используем идентификатор текущего пользователя
      };

      try {
        // Отправляем запрос на сервер для создания новой колонки
        const response = await fetch('http://localhost/X-men/back/create_column.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(newColumn),
        });

        // Получаем ответ от сервера и обрабатываем его
        const data = await response.json();
        if (data.id) {
          // Если создание колонки успешно, обновляем локальное состояние
          newColumn.id = data.id;
          newColumn.cards = [];
          newColumn.colors = ['#d9d9d9', '#d9d9d9', '#d9d9d9'];
          this.columns.push(newColumn); // Добавляем новую колонку в локальный массив columns
        }
      } catch (err) {
        // Ловим и выводим ошибку, если что-то пошло не так
        console.error('Ошибка:', err);
      }
    },

    async deleteColumn(index) {
      const column = this.columns[index];
      try {
        const response = await fetch('http://localhost/X-men/back/delete_column.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ id: column.id }),
        });
        const data = await response.json();
        if (data.success) {
          this.columns.splice(index, 1);
        }
      } catch (err) {
        console.error('Ошибка:', err);
      }
    },
    toggleEditMode() {
      this.isEditMode = !this.isEditMode;
    },
    updateOrder() {
      // handle drag and drop reorder
    },
    async fetchUserData() {
      try {
        // Отправляем запрос на сервер для получения данных о текущем пользователе
        const response = await fetch("http://localhost/X-men/back/login.php");
        const data = await response.json();
        this.loggedInUser = data.user_id; // Устанавливаем идентификатор пользователя в полученное значение
      } catch (error) {
        console.error("Ошибка:", error);
      }
    },
    logout() {
      // Реализуйте метод для выхода из системы
      console.log('Пользователь вышел из системы');
    },
  },
};
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

.board-page {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  font-family: 'Inter', sans-serif;
  /* height: 100vh;
  overflow: hidden; */
}

.board-header {
  display: flex;
  justify-content: space-between;
  width: 100%;
  padding: 20px 0;
}

.board-controls {
  display: flex;
  gap: 20px;
  margin-bottom: 20px;
}

.create-column-btn,
.edit-columns-btn {
  padding: 10px 20px;
  margin-top: 25px;
  border-radius: 8px;
  cursor: pointer;
  font-family: 'Inter', sans-serif;
  width: 300px;
}

.create-column-btn {
  background-color: #1362a0;
  color: white;
}

.edit-columns-btn {
  background-color: #d9d9d9;
  color: #032a4e;
}

.board-columns {
  display: flex;
  flex-direction: row;
  gap: 20px;
  width: 100%;
  overflow-x: auto;
}

.column-wrapper {
  position: relative;
}

.color-controls {
  display: flex;
  justify-content: center;
  gap: 5px;
  position: absolute;
  top: -30px;
  left: 50%;
  transform: translateX(-50%);
}

.color-circle {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  cursor: pointer;
}

.color-picker-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
}

.color-picker {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.color-options {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 10px;
}

.color-option {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  cursor: pointer;
}

.user-info {
  display: flex;
  align-items: center;
  gap: 10px;
  position: fixed;
  top: 35px;
  right: 5%;
}

.user-details {
  width: 241px;
  /* Возвращаем ширину блока к предыдущему значению */
  height: 45px;
  padding: 5px 10px;
  /* Уменьшаем отступы внутри блока */
  border-radius: 12px;
  /* Уменьшаем радиус закругления */
  overflow: hidden;
  border: 2px solid #295EA9;
  background: #fff;
  display: flex;
  justify-content: space-between;
  /* Изменяем выравнивание на центральное */
  align-items: center;
}

.user-name {
  text-align: center;
  /* Выравниваем текст по центру */
  color: #032A4E;
  font-size: 16px;
  font-family: Inter, sans-serif;
  font-weight: 700;
  word-wrap: break-word;
  flex: 1;
  /* Занимаем оставшееся пространство */
}

.logout-icon {
  width: 20px;
  height: 20px;
  cursor: pointer;
  /* Делаем курсор указателем при наведении */
  /* Изменяем позиционирование иконки */
  margin-right: 5px;
  /* Отодвигаем иконку от правого края */
}


.fixed-bar {
  position: fixed;
  top: 0;
  left: 5%;
  z-index: 1000;
  /* Устанавливаем z-index, чтобы контроли оставались поверх других элементов */
  padding: 10px;
  /* Добавляем отступы для улучшения визуального восприятия */
}
</style>

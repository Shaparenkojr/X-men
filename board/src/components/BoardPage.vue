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
            <div class="user-name">User123</div>
            <img src="../icons/logout.svg" alt="Logout" class="logout-icon" onclick="logout()">
          </div>
        </div>
      </div>
    </div>
    <draggable v-model="columns" :disabled="!isEditMode" @end="updateOrder" group="columns" class="board-columns">
      <template #item="{ element, index }">
        <TaskColumn
          :key="element.id"
          :column="element"
          :index="index"
          @updateColumn="updateColumn(index, $event)"
          @deleteColumn="deleteColumn(index)"
          @updateCards="updateCards(index, $event)"
          @changeColumnColor="changeColumnColor(index, $event)"
        />
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
      columns: [
        {
          id: 1,
          title: 'To Do',
          cards: [
            { id: 1, title: 'Task 1', description: 'Description 1', color: '#f4ae5b' },
            { id: 2, title: 'Task 2', description: 'Description 2', color: '#f4ae5b' },
          ],
          colors: ['#d9d9d9', '#d9d9d9', '#d9d9d9'],
        },
        {
          id: 2,
          title: 'In Progress',
          cards: [
            { id: 3, title: 'Task 3', description: 'Description 3', color: '#f4ae5b' },
          ],
          colors: ['#d9d9d9', '#d9d9d9', '#d9d9d9'],
        },
        {
          id: 3,
          title: 'Done',
          cards: [
            { id: 4, title: 'Task 4', description: 'Description 4', color: '#f4ae5b' },
          ],
          colors: ['#d9d9d9', '#d9d9d9', '#d9d9d9'],
        },
      ],
      isEditMode: false,
    };
  },
  methods: {
    createColumn() {
      const newColumn = {
        id: Date.now(),
        title: 'New Column',
        cards: [],
        colors: ['#d9d9d9', '#d9d9d9', '#d9d9d9'],
      };
      this.columns.push(newColumn);
    },
    deleteColumn(index) {
      this.columns.splice(index, 1);
    },
    toggleEditMode() {
      this.isEditMode = !this.isEditMode;
    },
    moveCard(card, fromColumnIndex, toColumnIndex) {
      const fromColumn = this.columns[fromColumnIndex];
      const toColumn = this.columns[toColumnIndex];

      const cardIndex = fromColumn.cards.findIndex(c => c.id === card.id);
      if (cardIndex !== -1) {
        fromColumn.cards.splice(cardIndex, 1);
        toColumn.cards.unshift(card); // Add to the top
      }
    },
    updateColumn(index, newTitle) {
      this.columns[index].title = newTitle;
    },
    updateCards(index, newCards) {
      this.columns[index].cards = newCards;
    },
    changeColumnColor(index, color) {
      this.columns[index].colors.unshift(color);
      this.columns[index].colors = this.columns[index].colors.slice(0, 3);
    },
    toggleOrder() {
      // implement the function to toggle column order
    },
    updateOrder() {
      // handle drag and drop reorder
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

.create-column-btn, .edit-columns-btn {
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
  width: 241px; /* Возвращаем ширину блока к предыдущему значению */
  height: 45px;
  padding: 5px 10px; /* Уменьшаем отступы внутри блока */
  border-radius: 12px; /* Уменьшаем радиус закругления */
  overflow: hidden;
  border: 2px solid #295EA9;
  background: #fff;
  display: flex;
  justify-content: space-between; /* Изменяем выравнивание на центральное */
  align-items: center;
}

.user-name {
  text-align: center; /* Выравниваем текст по центру */
  color: #032A4E;
  font-size: 16px;
  font-family: Inter, sans-serif;
  font-weight: 700;
  word-wrap: break-word;
  flex: 1; /* Занимаем оставшееся пространство */
}

.logout-icon {
  width: 20px;
  height: 20px;
  cursor: pointer; /* Делаем курсор указателем при наведении */
  /* Изменяем позиционирование иконки */
  margin-right: 5px; /* Отодвигаем иконку от правого края */
}


.fixed-bar{
  position: fixed;
  top: 0;
  left: 5%;
  z-index: 1000; /* Устанавливаем z-index, чтобы контроли оставались поверх других элементов */
  padding: 10px; /* Добавляем отступы для улучшения визуального восприятия */
}

</style>

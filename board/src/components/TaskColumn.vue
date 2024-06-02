<template>
  <div class="column">
    <div class="column-header">
      <div class="color-circles">
        <div
          v-for="(color, index) in column.colors"
          :key="index"
          :style="{ backgroundColor: color }"
          class="color-circle"
          @click="openColorPicker"
        ></div>
      </div>
      <button class="delete-column-btn" @click="confirmDeleteColumn">
        <i class="fas fa-trash"></i>
      </button>
    </div>
    <div :style="{ backgroundColor: backgroundColor }" class="column-body">
      <div class="column-title" :style="{ color: textColor }">
        <div @dblclick="toggleEditMode">
          <span v-if="!isEditMode">{{ localTitle }}</span>
          <input
            v-else
            v-model="localTitle"
            @blur="saveColumn"
            @keydown.enter="saveColumn"
            class="column-input"
          />
        </div>
      </div>
      <button class="create-card-btn" @click="createCard">
        <span class="btn-text">Создать карточку</span>
      </button>
      <draggable v-model="localCards" group="cards" class="cards" @change="updateCardsOrder">
        <template #item="{ element, index }">
          <TaskCard
            :card="element"
            @updateCard="updateCard(index, $event)"
            @deleteCard="deleteCard(index)"
            @changeColor="changeCardColor(index, $event)"
          />
        </template>
      </draggable>
      <div v-if="showColorPicker" class="color-picker-overlay" @click="closeColorPicker">
        <div class="color-picker" @click.stop>
          <h3>Выберите цвет</h3>
          <div class="color-options">
            <div
              v-for="color in availableColors"
              :key="color"
              class="color-option"
              :style="{ backgroundColor: color }"
              @click="selectColor(color)"
            ></div>
          </div>
        </div>
      </div>
      <div v-if="showDeleteConfirmation" class="delete-confirmation">
        <p>Вы точно хотите удалить колонку и ее содержимое?</p>
        <div class="confirmation-buttons">
          <button class="confirm-btn" @click="deleteColumn">Да</button>
          <button class="cancel-btn" @click="hideDeleteConfirmation">Нет</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TaskCard from './TaskCard.vue';
import draggable from 'vuedraggable';

export default {
  name: 'TaskColumn',
  components: {
    TaskCard,
    draggable,
  },
  props: {
    column: Object,
    index: Number,
  },
  data() {
    return {
      isEditMode: false,
      localTitle: this.column.title,
      localCards: [...this.column.cards],
      showColorPicker: false,
      showDeleteConfirmation: false,
      availableColors: [
        '#666666', '#66664D', '#9900B3', '#991AFF', '#FF4D4D', '#B33300', '#999966', '#CC9999',
        '#CCCC00', '#999933', '#809980', '#4D8066', '#4DB380', '#B33300', '#E64D66', '#E6331A',
        '#FF5733', '#B34D4D', '#E6B3B3', '#FF1A66', '#E666FF', '#FF3380', '#FF33FF', '#1AB399',
        '#4DB3FF', '#66991A', '#99E6E6', '#80B300', '#33FFFF', '#00E680', '#33FFCC', '#66E64D',
        '#FFFF33', '#99FF99', '#E6FF80', '#FFB399', '#FFB3E6'
      ],
    };
  },
  methods: {
    toggleEditMode() {
      this.isEditMode = !this.isEditMode;
    },
    saveColumn() {
      this.$emit('updateColumn', this.localTitle);
      this.isEditMode = false;
    },
    confirmDeleteColumn() {
      this.showDeleteConfirmation = true;
    },
    hideDeleteConfirmation() {
      this.showDeleteConfirmation = false;
    },
    deleteColumn() {
      this.$emit('deleteColumn');
    },
    createCard() {
      const newCard = {
        id: Date.now(),
        description: '',
        color: '#666666',
      };
      this.localCards.unshift(newCard);
      this.$emit('updateCards', this.localCards);
    },
    updateCard(cardIndex, newCard) {
      this.localCards.splice(cardIndex, 1, newCard);
      this.$emit('updateCards', this.localCards);
    },
    deleteCard(cardIndex) {
      this.localCards.splice(cardIndex, 1);
      this.$emit('updateCards', this.localCards);
    },
    updateCardsOrder() {
      this.$emit('updateCards', this.localCards);
    },
    changeCardColor(cardIndex, color) {
      this.localCards[cardIndex].color = color;
      this.$emit('updateCards', this.localCards);
    },
    openColorPicker() {
      this.showColorPicker = true;
    },
    closeColorPicker() {
      this.showColorPicker = false;
    },
    selectColor(color) {
      this.$emit('changeColumnColor', color);
      this.closeColorPicker();
    },
    calculateBrightness(color) {
      const r = parseInt(color.substring(1, 3), 16);
      const g = parseInt(color.substring(3, 5), 16);
      const b = parseInt(color.substring(5, 7), 16);
      return (r * 299 + g * 587 + b * 114) / 1000;
    }
  },
  computed: {
    backgroundColor() {
      return this.column.colors[0];
    },
    textColor() {
      const brightness = this.calculateBrightness(this.backgroundColor);
      return brightness > 125 ? 'black' : 'white';
    },
  },
  watch: {
    column: {
      handler(newVal) {
        this.localTitle = newVal.title;
        this.localCards = [...newVal.cards];
      },
      deep: true,
    },
  },
};
</script>

<style scoped>
.column {
  display: flex;
  flex-direction: column;
  height: 100%; /* Устанавливаем высоту .column на 100% */

  width: 300px;
  background-color: #eee;
  padding: 0;
  border-radius: 8px;
  font-family: 'Inter', sans-serif;
}

.column-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

.color-circles {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.color-circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  cursor: pointer;
}

.delete-column-btn {
  width: 20px;
  height: 20px;
  background-color: red;
  border: none;
  padding: 0;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0;
}

.delete-column-btn:hover {
  background-color: darkred;
}

.column-body {
  flex: 1; 
  background-color: inherit;
  border-radius: 8px;
  padding: 10px;
}

.column-title {
  font-size: 1.2em;
  font-weight: 600;
  cursor: pointer;
  word-wrap: break-word;
  white-space: normal;
}

.column-input {
  font-size: 1.2em;
  font-weight: 600;
  width: 100%;
  border: none;
  outline: none;
}

.create-card-btn {
  position: relative;
  background-color: #d9d9d9;
  border: none;
  padding: 10px 10px;
  border-radius: 5px;
  cursor: pointer;
  transition: height 0.2s ease;
  width: 100%;
  margin-top: 10px;
  height: 50px;
}

.create-card-btn .btn-text {
  color: #666666;
  transition: color 0.3s ease;
}

.create-card-btn:hover {
  background-color: #f4ae5b;
  height: 80px;
  transition: background-color 0.2s ease;
}

.create-card-btn::before {
  content: '+'; 
  font-size: 1.5em; 
  color: #666666; /* Серый цвет плюса */
  position: absolute; 
  left: 15px; 
  top: 50%; 
  transform: translateY(-55%); 
  transition: font-size 0.2s ease, color 0.2s ease; /* Добавляем переходы для изменения размера и цвета плюса */
}

.create-card-btn:hover::before {
  font-size: 3em;
  left: 40px;  
  color: black; /* Изменяем цвет плюса на белый при наведении */
}

.create-card-btn:hover .btn-text {
  color: black;
  transform: translateX(20px); 
  white-space: normal; 
  display: inline-block; 
  padding-left: 30px; 
  padding-right: 40px; 
}

.btn-text {
  margin-left: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-text::before {
  margin-right: 10px;
  font-size: 1.5em;
}

.cards {
  margin-top: 10px;
  display: flex;
  flex-direction: column;
  gap: 10px;
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
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 10px;
  margin-top: 10px;
}

.color-option {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  cursor: pointer;
}

.delete-confirmation {
  position: fixed;
  top: 80%; /* Размещаем по вертикали на середине экрана */
  left: 50%; /* Размещаем по горизонтали на середине экрана */
  transform: translate(-50%, -20%); /* Центрируем по центру экрана */
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  z-index: 999;
}

.confirmation-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
}

.confirm-btn {
  background-color: green;
  color: white;
  border: none;
  padding: 10px;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
}

.cancel-btn {
  background-color: red;
  color: white;
  border: none;
  padding: 10px;
  margin: 5px;
  border-radius: 5px;
  cursor: pointer;
}
</style>
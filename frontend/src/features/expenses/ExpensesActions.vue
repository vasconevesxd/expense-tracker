<script lang="ts" setup>
  const emit = defineEmits<{ openDialog: [type: 'expense' | 'category'] }>()

  const openDialogExpense = () => {
    emit('openDialog', 'expense')
  }

  const openDialogCategory = () => {
    emit('openDialog', 'category')
  }
</script>

<template>
  <q-btn label="Add Expense" color="primary" @click="openDialogExpense" />
  <q-btn label="Add Category" color="primary" @click="openDialogCategory" />
</template>

<script lang="ts" setup>
  import ExpensesTable from '@/features/expenses/ExpensesTable.vue'
  import ExpensesActionsDialog from '@/features/expenses/ExpensesActionsDialog.vue'
  import { useExpenses } from '@/features/expenses/composables/useExpenses'
  import {
    createExpense,
    deleteExpense,
    updateExpense,
  } from '@/features/expenses/services'
  import type { Expense } from '@/features/expenses/types'
  import CategoriesActionsDialog from '@/features/categories/CategoriesActionsDialog.vue'
  import { createCategory } from '@/features/categories/services'
  import type { Category } from '@/features/categories/types'

  const { expenses } = useExpenses()

  const dialogVisible = ref(false)
  const isNewExpense = ref(false)
  const selectedExpense = ref<Expense | null>(null)

  const dialogVisibleCategory = ref(false)

  const openDialog = (expense: Expense) => {
    selectedExpense.value = expense
    isNewExpense.value = false
    dialogVisible.value = true
  }

  const openDialogCategory = () => {
    dialogVisibleCategory.value = true
  }

  const newCategory = (category: Category) => {
    createCategory(category)
    dialogVisibleCategory.value = false
  }

  watch(
    () => dialogVisible.value,
    () => {
      if (dialogVisible.value) return
      selectedExpense.value = null
    }
  )
</script>

<template>
  <q-page padding>
    <h5 class="q-mb-md">Expenses</h5>
    <q-btn
      label="Add Expense"
      color="primary"
      @click="
        {
          ;(dialogVisible = true), (isNewExpense = true)
        }
      "
    />
    <ExpensesTable
      v-if="expenses"
      :expenses="expenses"
      @openDialog="openDialog"
    />
    <ExpensesActionsDialog
      v-model="dialogVisible"
      :expense="selectedExpense"
      :isEditing="isNewExpense"
      @create="createExpense"
      @update="updateExpense"
      @delete="deleteExpense"
      @close="dialogVisible = false"
      @openDialogCategory="openDialogCategory"
    />
    <CategoriesActionsDialog
      v-model="dialogVisibleCategory"
      @save="newCategory"
    />
  </q-page>
</template>

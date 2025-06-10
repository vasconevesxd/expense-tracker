<script lang="ts" setup>
  import { api } from '@/boot/axios'
  import { useDialogPluginComponent } from 'quasar'

  const { dialogRef, onDialogHide } = useDialogPluginComponent()

  const expenses = ref()

  api.get('/expenses').then(response => {
    expenses.value = response.data
  })

  const expense = ref()

  function openDialog(currentExpense: any) {
    expense.value = currentExpense
    dialogRef.value = true
  }

  function deleteExpense(currentExpense: any) {
    api.delete(`/expenses/${currentExpense.id}`).then(() => {
      expenses.value = expenses.value.filter(
        (e: any) => e.id !== currentExpense.id
      )
    })
    dialogRef.value = false
    onDialogHide()
    expense.value = null
  }

  function editExpense() {
    api
      .put(`/expenses/${expense.value.id}`, {
        category_id: expense.value.category_id,
        amount: expense.value.amount,
      })
      .then(() => {
        expenses.value = expenses.value.map((e: any) =>
          e.id === expense.value.id
            ? {
                ...e,
                category_id: expense.value.category_id,
                amount: expense.value.amount,
              }
            : e
        )
      })
    dialogRef.value = false
    onDialogHide()
    expense.value = null
  }

  function openDialogExpense() {
    dialogRef.value = true
    expense.value = {
      category_id: '',
      amount: '',
    }
  }

  function openDialogCategory() {
    dialogCategoryRef.value = true
    expense.value = {
      name: '',
    }
  }

  function addCategory() {
    api.post('/expense-categories', { name: expense.value.name }).then(() => {
      expenses.value = expenses.value.map((e: any) =>
        e.id === expense.value.id ? { ...e, name: expense.value.name } : e
      )
    })
    dialogCategoryRef.value = false
    onDialogHide()
    expense.value = null
  }

  const dialogCategoryRef = ref()
</script>

<template>
  <q-page padding>
    <div class="text-h4 q-mb-md">Expenses</div>
    <div class="flex justify-end gap-2">
      <q-btn label="Add Expense" color="primary" @click="openDialogExpense" />
      <q-btn label="Add Category" color="primary" @click="openDialogCategory" />
    </div>
    <q-list>
      <q-item v-for="expense in expenses" :key="expense.id">
        <q-item-section>
          <q-item-label>{{ expense.category_id }}</q-item-label>
        </q-item-section>
        <q-item-section>
          <q-item-label>{{ expense.amount }}</q-item-label>
        </q-item-section>
        <q-item-section side>
          <q-item-label class="flex justify-center items-center gap-4" caption>
            <q-icon
              name="edit"
              color="primary"
              size="20px"
              @click="openDialog(expense)"
            />
            <q-icon
              name="delete"
              color="negative"
              size="20px"
              @click="deleteExpense(expense)"
            />
          </q-item-label>
        </q-item-section>
      </q-item>
    </q-list>

    <q-dialog v-model="dialogRef" @hide="onDialogHide">
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Edit Expense</div>
        </q-card-section>

        <q-card-section class="q-pt-none q-gutter-y-md">
          <q-input v-model="expense.category_id" filled label="Category" />
          <q-input
            v-model="expense.amount"
            filled
            label="Amount"
            type="number"
          />
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn v-close-popup flat label="Cancel" />
          <q-btn v-close-popup flat label="OK" @click="editExpense" />
        </q-card-actions>
      </q-card>
    </q-dialog>

    <q-dialog v-model="dialogCategoryRef" @hide="onDialogHide">
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Add Category</div>
        </q-card-section>

        <q-card-section class="q-pt-none q-gutter-y-md">
          <q-input v-model="expense.name" filled label="Name" />
        </q-card-section>

        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn v-close-popup flat label="Cancel" />
          <q-btn v-close-popup flat label="OK" @click="addCategory" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup lang="ts">
  import type { Expense } from '@/features/expenses/types'
  import { useQuasar } from 'quasar'
  import { getCategory } from '@/features/categories/services'
  import { getExpenseTypes } from '@/features/expenseTypes/services'

  interface Props {
    expense: Expense | null
    isEditing: boolean
  }

  const props = defineProps<Props>()
  const emit = defineEmits<{
    (e: 'create', expense: Expense): void
    (e: 'update', expense: Expense): void
    (e: 'delete', id: number): void
    (e: 'close'): void
    (e: 'openDialogCategory'): void
  }>()

  const $q = useQuasar()
  const editing = ref(false)
  const isEditable = computed(() => props.isEditing || editing.value)
  const isLoading = ref(false)
  const formError = ref<string | null>(null)

  const expenseForm = ref<Partial<Expense>>({
    description: '',
    category_id: null,
    type_id: null,
    amount: '',
    date: '',
  })

  const { data: categories } = getCategory()
  const { data: expenseTypes } = getExpenseTypes()

  watch(
    () => props.expense,
    newExpense => {
      if (newExpense) {
        onSetup()
      }
    },
    { deep: true, immediate: true }
  )

  function onSetup() {
    if (!props.expense) return

    expenseForm.value = {
      description: props.expense.description,
      category_id: props.expense.category_id,
      type_id: props.expense.type_id,
      amount: props.expense.amount.toString(),
      date: props.expense.date,
    }
  }

  function startEditing() {
    editing.value = true
  }

  function onSave() {
    if (!validateForm()) return

    isLoading.value = true
    try {
      const expenseData = !expenseForm.value.id
        ? { ...expenseForm.value }
        : { ...props.expense, ...expenseForm.value }

      emit('create', expenseData)
      onReset()
      emit('close')
    } catch (error) {
      $q.notify({
        type: 'negative',
        message: 'Failed to save expense',
      })
    } finally {
      isLoading.value = false
    }
  }

  function onDelete() {
    if (!expenseForm.value.id) return

    $q.dialog({
      title: 'Confirm',
      message: 'Are you sure you want to delete this expense?',
      cancel: true,
      persistent: true,
    }).onOk(() => {
      try {
        isLoading.value = true
        emit('delete', expenseForm.value.id)
        onReset()
        emit('close')
      } catch (error: any) {
        $q.notify({
          type: 'negative',
          message: 'Failed to delete expense',
        })
      } finally {
        isLoading.value = false
      }
    })
  }

  function validateForm(): boolean {
    if (!expenseForm.value.category_id) {
      formError.value = 'Category is required'
      return false
    }
    if (!expenseForm.value.type_id) {
      formError.value = 'Type is required'
      return false
    }
    if (!expenseForm.value.amount || Number(expenseForm.value.amount) <= 0) {
      formError.value = 'Amount must be greater than 0'
      return false
    }
    if (!expenseForm.value.date) {
      formError.value = 'Date is required'
      return false
    }
    formError.value = null
    return true
  }

  function openDialogCategory() {
    emit('openDialogCategory')
  }

  function onCancel() {
    onReset()
    onSetup()
    emit('close')
  }

  function onReset() {
    expenseForm.value = {
      description: '',
      category_id: null,
      type_id: null,
      amount: '',
      date: '',
    }
    editing.value = false
    formError.value = null
  }
</script>

<template>
  <q-dialog @hide="onReset()">
    <q-card style="min-width: 350px">
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6">{{ isEditing ? 'Add' : 'Edit' }} Expense</div>
        <q-space />
        <q-btn v-close-popup icon="close" flat round dense @click="onReset()" />
      </q-card-section>

      <q-card-section>
        <q-inner-loading :showing="isLoading">
          <q-spinner-gears size="50px" color="primary" />
        </q-inner-loading>

        <div
          v-if="categoryError || expenseTypeError"
          class="text-negative q-mb-md"
        >
          Failed to load categories or expense types
        </div>

        <div class="q-gutter-md">
          <q-select
            v-model="expenseForm.category_id"
            :options="categories"
            option-label="name"
            option-value="id"
            label="Category *"
            map-options
            emit-value
            :readonly="!isEditable"
            :disable="!categories"
            :error="formError?.includes('Category')"
            error-message="Category is required"
          >
            <template v-slot:append>
              <q-btn
                round
                dense
                flat
                icon="add"
                :disable="!isEditable"
                @click.stop.prevent="openDialogCategory"
              />
            </template>
          </q-select>

          <q-select
            v-model="expenseForm.type_id"
            :options="expenseTypes"
            option-label="name"
            option-value="id"
            label="Type *"
            map-options
            emit-value
            :readonly="!isEditable"
            :disable="!expenseTypes"
            :error="formError?.includes('Type')"
            error-message="Type is required"
          />

          <q-input
            v-model="expenseForm.amount"
            label="Amount (€) *"
            type="number"
            step="0.01"
            min="0"
            :readonly="!isEditable"
            :error="formError?.includes('Amount')"
            error-message="Amount must be greater than 0"
          />

          <q-input
            v-model="expenseForm.date"
            label="Date *"
            type="date"
            :readonly="!isEditable"
            :error="formError?.includes('Date')"
            error-message="Date is required"
          />

          <q-input
            v-model="expenseForm.description"
            type="textarea"
            label="Description"
            autogrow
            :readonly="!isEditable"
          />
        </div>
      </q-card-section>

      <q-card-actions>
        <q-btn
          v-if="!isEditable"
          flat
          label="Delete"
          color="negative"
          @click="onDelete"
        />
        <q-space />
        <q-btn
          v-if="isEditable"
          flat
          label="Cancel"
          color="primary"
          @click="onCancel"
        />
        <q-btn
          v-if="!isEditable"
          flat
          label="Edit"
          color="primary"
          @click="startEditing"
        />
        <q-btn
          v-if="isEditable"
          flat
          label="Save"
          color="positive"
          :loading="isLoading"
          @click="onSave"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

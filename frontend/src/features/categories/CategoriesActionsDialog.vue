<script setup lang="ts">
  import type { Category } from '@/features/categories/types'

  const props = defineProps<{
    category: Category
    isDialogOpen: boolean
  }>()

  const emit = defineEmits<{
    (e: 'delete', id: number): void
    (e: 'save', updated: Category): void
  }>()

  const openDialog = ref(false)
  const editing = ref(false)
  const isEditable = ref(false)

  const categoryForm = ref({
    name: '',
  } as Category)

  watch(
    () => props.category,
    () => {
      if (!props.category) {
        isEditable.value = false
        return
      }

      categoryForm.value = {
        name: props.category.name,
      }
      isEditable.value = true
      editing.value = false
      openDialog.value = props.isDialogOpen
    }
  )

  function startEditing() {
    editing.value = true
    openDialog.value = true
  }

  function onSave() {
    emit('save', { ...props.category, ...categoryForm.value })

    onReset()
  }

  function onDelete() {
    if (categoryForm.value?.id) {
      emit('delete', categoryForm.value.id)
    }
    onReset()
  }

  function onReset() {
    categoryForm.value = {
      name: '',
    }
    isEditable.value = false
    editing.value = false
    openDialog.value = false
  }
</script>

<template>
  <q-dialog v-model="openDialog">
    <q-card style="min-width: 350px">
      <q-card-section class="row items-center q-pb-none">
        <div class="text-h6">Category Details</div>
        <q-space />
        <q-btn v-close-popup icon="close" flat round dense />
      </q-card-section>
      <q-card-section>
        <div class="q-gutter-md">
          <q-input
            v-model="categoryForm.name"
            label="Name"
            type="text"
            :readonly="!editing && isEditable"
          />
        </div>
      </q-card-section>

      <q-card-actions>
        <template v-if="isEditable">
          <q-btn
            v-if="!editing"
            flat
            label="Delete"
            color="negative"
            @click="onDelete"
          />
          <q-space />
          <q-btn
            v-if="editing"
            flat
            label="Cancel"
            color="primary"
            @click="onReset"
          />
          <q-btn
            v-if="!editing"
            flat
            label="Edit"
            color="primary"
            @click="startEditing"
          />
          <q-btn
            v-if="editing"
            flat
            label="Save"
            color="positive"
            @click="onSave"
          />
        </template>
        <template v-else>
          <q-btn flat label="Cancel" color="primary" @click="onReset" />
          <q-space />
          <q-btn flat label="Save" color="positive" @click="onSave" />
        </template>
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

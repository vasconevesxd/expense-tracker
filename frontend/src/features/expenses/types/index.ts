import type { ExpenseTypes } from './enums'

export interface ExpenseCategory {
  id: number
  name: string
  created_at: string
  updated_at: string
}

export interface ExpenseType {
  id: number
  name: ExpenseTypes
  created_at: string
  updated_at: string
}

export interface Expense {
  id: number
  category_id: number
  type_id: number
  amount: string
  date: string
  description: string
  created_at: string
  updated_at: string
  category: ExpenseCategory
  expense_type: ExpenseType
}

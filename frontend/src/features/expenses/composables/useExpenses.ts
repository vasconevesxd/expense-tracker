import { getExpenses } from '@/features/expenses/services'

export const useExpenses = () => {
  const expenses = getExpenses()

  return {
    expenses: expenses.data,
  }
}

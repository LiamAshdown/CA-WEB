export default {
  bill (state) {
    return state.bill
  },
  items (state) {
    return state.bill.items
  },
  taxes (state) {
    return state.bill.taxes
  },
  saveDraft (state) {
    return state.saveDraft
  }
}

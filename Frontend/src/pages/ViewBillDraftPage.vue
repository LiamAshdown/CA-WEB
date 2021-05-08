<template>
  <b-container fluid>
    <div class="overlay" v-if="loading">
      <div class="overlay__loading loading rounded">
        <h4 class="text-primary mb-4">Generating Estimate...</h4>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <b-row class="draft" v-else>
      <b-col lg="12" class="h-100 d-flex justify-content-center">
        <div class="draft__draft w-100 shadow">
          <table cellpadding="0" cellspacing="0" class="invoice-box w-100 mb-60">
            <tr>
                <td class="px-0 py-2">
                    <img class="logo" :src="company.logoPath" alt="Company Logo">
                </td>
                <td class=" text-right">
                    <h1 class="text-primary">Estimate #{{ estimate.estimateNumber }}</h1>
                </td>
            </tr>
            <tr class="text-right">
                <td></td>
                <td>
                    <b>{{ company.name  }}</b><br />
                    {{ company.address }}<br />
                    {{ company.postalCode }}<br />
                    {{ company.telephoneNumber }}<br />
                </td>
            </tr>
          </table>

          <table cellpadding="0" cellspacing="0" class="invoice-box w-100">
            <tr>
              <td class="p-0">
                <table cellpadding="0" cellspacing="0" class="invoice-box w-75 m-0">
                  <thead class="border-bottom text-left background-primary text-white">
                    <tr>
                      <th class="font-weight-normal py-5 pl-5">Bill To</th>
                      <th class="font-weight-normal py-5">Date</th>
                      <th class="font-weight-normal py-5">Due Date</th>
                    </tr>
                  </thead>
                  <tr class="item vertical-align-top">
                    <td class="pl-5">
                        <b>{{ estimate.customer.name }}</b><br />
                        <p>{{ estimate.customer.billingAddress }}</p>
                        <p>{{ estimate.customer.billingPostalCode }}</p>
                        <p v-if="estimate.customer.billingTelephoneNumber">{{ estimate.customer.billingTelephoneNumber }}</p>
                        <p v-else>{{ estimate.customer.telephoneNumber }}</p>
                    </td>

                    <td>04/02/2020</td>
                    <td>{{ estimate.dueDate }}</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <table cellpadding="0" cellspacing="0" class="invoice-box w-100 mt-30">
            <thead class="border-bottom text-left background-primary text-white">
              <tr>
                <th class="font-weight-normal py-5 pl-5">#</th>
                <th class="font-weight-normal py-5">Description</th>
                <th class="font-weight-normal py-5">Quantity</th>
                <th class="font-weight-normal py-5">Unit Price</th>
                <th class="font-weight-normal py-5 text-center">Total</th>
              </tr>
            </thead>
            <tr
                v-for="(item, index) in items"
                :key="item.uniqueId"
                class="item"
              >
              <td class="border-bottom pl-5">{{ index + 1}}</td>
              <td class="border-bottom pl-5">{{ item.name }}</td>
              <td class="border-bottom pl-5">{{ item.quantity }}</td>
              <td class="border-bottom pl-5">£{{ item.price.toLocaleString('en-GB', {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
                }) }}
              </td>
              <td class="border-bottom pl-5 text-center">£{{ (item.price * item.quantity).toLocaleString('en-GB', {
                  minimumFractionDigits: 2,
                  maximumFractionDigits: 2
                }) }}</td>
            </tr>
          </table>

          <table class="invoice-box w-100">
            <tr class="heading text-right">
              <td>SubTotal</td>
              <td class="w-10 text-black"><span class="total">£{{ calculateSubTotalAmount }}</span></td>
            </tr>
            <tr
                v-for="tax in taxes"
                :key="tax.uniqueId"
                class="heading text-right"
                colspan="4"
              >
              <td class="pt-0">{{ tax.name }}</td>
              <td class="w-10 pt-0 text-black"><span class="total">{{ tax.tax }}%</span></td>
            </tr>
            <tr class="heading text-right">
              <td>Total</td>
              <td class="w-10 text-primary font-weight-bold"><span class="total text-primary">£{{ calculateTotalAmount }}</span></td>
            </tr>
          </table>

          <table class="invoice-box" v-if="notes || terms" :class="{
            'w-50 m-0': (!notes && terms) || (notes && !terms),
            'w-100': notes && terms
          }">
            <thead class="border-bottom text-left heading">
              <tr>
                <th class="font-weight-normal py-5 pl-5" v-if="terms">Terms & Conditions</th>
                <th class="font-weight-normal py-5" v-if="notes">Notes</th>
              </tr>
            </thead>
            <tr class="item">
              <td class="pl-5 draft__terms_notes" v-if="terms">
                <bill-draft-editor v-model="terms" class="draft__editor draft__editor--terms"></bill-draft-editor>
              </td>
              <td class="vertical-align-top draft__terms_notes" v-if="notes">
                <bill-draft-editor v-model="notes" class="draft__editor draft__editor--terms" id="testpopper"></bill-draft-editor>
              </td>
            </tr>
          </table>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters } from 'vuex'
import api from '@/api/index.js'
import BillDraftEditor from '@/components/billing/BillDraftEditor.vue'

export default {
  components: { BillDraftEditor },
  name: 'ViewBillDraftPage',
  data () {
    return {
      terms: '',
      notes: '',
      logo: null,
      company: {
        name: '',
        telephoneNumber: '',
        postalCode: '',
        address: '',
        logoPath: ''
      },
      loading: true
    }
  },
  watch: {
    saveDraft () {
      this.$store.dispatch('bills/set', {
        estimateBody: this.notes,
        termsConditions: this.terms
      })
    }
  },
  computed: {
    ...mapGetters({
      estimate: 'bills/bill',
      items: 'bills/items',
      taxes: 'bills/taxes',
      saveDraft: 'bills/saveDraft'
    }),
    calculateTotalAmount () {
      let total = 0

      for (const item of this.items) {
        let price = item.price
        for (const tax of this.taxes) {
          price = price - (price * (tax.tax / 100))
        }
        total += Number(price) * item.quantity
      }

      return total.toLocaleString('en-GB', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    },
    calculateSubTotalAmount () {
      let subTotal = 0

      for (const item of this.items) {
        subTotal += Number(item.price) * item.quantity
      }

      return subTotal.toLocaleString('en-GB', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      })
    }
  },
  methods: {
    async getCompany () {
      const response = await api.company.show()
      this.company = response

      this.loading = false
    }
  },
  created () {
    // No Customer? Then Estimate hasn't been created yet
    if (!this.estimate.customer) {
      this.$router.push({ name: 'CreateBill' })
    } else {
      this.getCompany()
      this.notes = this.estimate.body
      this.terms = this.estimate.termsConditions
    }
  }
}
</script>

<style lang="scss" scoped>
.draft {
  &__draft {
    max-width: 800px;
    background-color: white;
    margin: 0px;
    height: 1100px;
    padding-left: 40px;
    padding-right: 40px;
    overflow: hidden;

    // Override default boostrap
    table {
      max-width: 800px;
      margin: auto;
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
    }

    .heading {
      color: #aaaaaa;
      text-transform: uppercase;
      font-size: 12px;
    }

    .total {
      font-size: 16px;
    }

    /* -- Helpers -- */
    .text-primary {
      color: #006bff !important;
    }
    .text-white {
      color: #ffffff !important;
    }
    .text-black {
      color: #000000 !important;
    }
    .text-center {
      text-align: center
    }
    table .text-left {
      text-align: left;
    }
    table .text-right {
      text-align: right;
    }
    .border-0 {
      border: none;
    }

    .background-primary {
      background-color: #006bff
    }

    .font-weight-bold {
      font-weight: bold
    }
    .font-weight-normal {
      font-weight: normal
    }

    .pt-0 {
      padding-top: 0px !important;
    }
    .p-0 {
      padding: 0px !important;
    }
    .p-5 {
      padding: 5px !important;
    }
    .p-10 {
      padding: 10px !important;
    }
    .pl-10 {
      padding-left: 10px !important;
    }
    .pl-5 {
      padding-left: 5px !important;
    }
    .py-10 {
      padding-bottom: 10px !important;
      padding-top: 10px !important;
    }
    .py-5 {
      padding-bottom: 5px !important;
      padding-top: 5px !important;
    }

    .m-0 {
      margin: 0px !important;
    }
    .mt-30 {
      margin-top: 30px !important;
    }
    .mb-60 {
      margin-bottom: 60px !important;
    }
    .my-20 {
      margin-top: 20px !important;
      margin-bottom: 20px !important;
    }

    .w-10 {
      width: 10%;
    }
    .w-20 {
      width: 20%
    }
    .w-30 {
      width: 30%;
    }
    .w-75 {
      width: 75%;
    }
    .w-100 {
      width: 100%;
    }

    .vertical-align-top {
      vertical-align: top;
    }

    .border-bottom {
      border-bottom: 0.620315px solid #E8E8E8;
    }
  }

  &__terms_notes {
    width: 50%;
    max-width: 50%;
  }

  &__editor {
    transition: border-color 0.3s ease-in-out;
    border-width: 2px;
    border-style: dashed;
    border-color: white;
    border-top: none;

    &:hover {
      border-color: #e2e2e2;
    }
  }

  &__editor--terms {
    width: 100%;
    max-width: 360px;
  }
}

.loading span {
  display: inline-block;
  vertical-align: middle;
  width: 2em;
  height: 2em;
  margin: .19em;
  background: #007DB6;
  border-radius: 1em;
  animation: loading 1s infinite alternate;

  &:nth-of-type(2) {
    background: #4b778d;
    animation-delay: 0.2s;
  }
  &:nth-of-type(3) {
    background: #28b5b5;
    animation-delay: 0.4s;
  }
  &:nth-of-type(4) {
    background: #8fd9a8;
    animation-delay: 0.6s;
  }
  &:nth-of-type(5) {
    background: #d2e69c;
    animation-delay: 0.8s;
  }
  &:nth-of-type(6) {
    background: #4b778d;
    animation-delay: 1.0s;
  }
  &:nth-of-type(7) {
    background: #28b5b5;
    animation-delay: 1.2s;
  }
}

@keyframes loading {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 999999;
  background-color: #f6f7fc;
  text-align: center;

  &__loading {
    margin: auto;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    height: 400px;
  }
}
</style>

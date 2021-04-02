<template>
  <b-form-group
    :id="id"
    :label="getLabel"
    :label-for="inputId"
    :description="description"
    class="font-weight-medium"
    >
      <b-form-select
        v-if="select"
        :aria-invalid="getErrorType === false ? 'true' : 'false'"
        :class="{ 'is-invalid': getErrorType === false }"
        :value="value"
        @change="$emit('input', $event, valueName )"
        v-bind="$attrs"
      >
        <template #first v-if="placeholder">
          <b-form-select-option :value="null" disabled>{{ placeholder }}</b-form-select-option>
        </template>
      </b-form-select>
      <textarea
        v-else-if="textArea"
        :id="inputId"
        :type="type"
        :placeholder="placeholder"
        :aria-invalid="getErrorType === false ? 'true' : 'false'"
        class="form-control"
        :class="{ 'is-invalid': getErrorType === false }"
        :value="value"
        @input="$emit('input', $event.target.value, valueName )"
        rows="4"
        v-bind="$attrs"
      >
      </textarea>
      <input
        v-else
        :id="inputId"
        :type="type"
        :placeholder="placeholder"
        :aria-invalid="getErrorType === false ? 'true' : 'false'"
        class="form-control"
        :class="{ 'is-invalid': getErrorType === false }"
        :value="value"
        @input="$emit('input', $event.target.value, valueName )"
        v-bind="$attrs"
      />
      <b-form-invalid-feedback :state="getErrorType === false">
        {{ getErrorMessage }}
      </b-form-invalid-feedback>
  </b-form-group>
</template>

<script>
import { camelize } from 'humps'

/**
 * Used for creating Input/TextArea Fields
 * @displayName Base Form Group
 */
export default {
  props: {
    /**
     * Id of Input
     */
    id: {
      type: String,
      required: true
    },
    /**
     * Label for Input
     */
    label: {
      type: String,
      required: true
    },
    /**
     * Type of Input
     */
    type: {
      type: String,
      required: false,
      default: 'text'
    },
    /**
     * Input Placeholder
     */
    placeholder: {
      type: String,
      required: false,
      default: ''
    },
    /**
     * Enables Client side validation
     * @deprecated Currently not implemented
     */
    required: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * v-model Value
     */
    value: {
      type: [Array, String]
    },
    /**
     * Changes Input to TextArea
     */
    textArea: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * Changes Input to select
     */
    select: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * Add a description to the Input
     */
    description: {
      type: String,
      required: false,
      default: ''
    },
    /**
     * Whether the Input is required (adds * to label)
     */
    optional: {
      type: Boolean,
      required: false,
      default: true
    },
    /**
     * Validation passed from Parent Component
     */
    validation: {
      required: false,
      default () {
        return []
      }
    }
  },
  computed: {
    inputId () {
      return this.id + '-input'
    },
    getErrorType () {
      return this.validation[this.validationName] !== undefined ? false : null
    },
    getErrorMessage () {
      return this.validation[this.validationName] ? this.validation[this.validationName][0] : ''
    },
    getLabel () {
      return !this.optional ? `${this.label}*` : this.label
    }
  },
  data () {
    return {
      validationName: '', // Validation
      valueName: '' // API
    }
  },
  mounted () {
    this.validationName = this.id.replace(/-/g, '_')
    this.valueName = camelize(this.id)
  }
}
</script>

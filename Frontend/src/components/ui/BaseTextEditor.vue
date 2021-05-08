<template>
  <div class="editor" v-if="editor">
    <base-text-editor-menu class="editor__header" :editor="editor"></base-text-editor-menu>
    <div class="editor__menu" v-click-outside="hideInsertFields">
      <b-button ref="insertFieldRef" variant="outline-primary" @click="showInsertFields"><b-icon icon="plus"></b-icon>Insert Field</b-button>
      <div ref="insertFieldPop" class="editor__float_menu shadow-sm rounded mt-1 p-2">
        <b-row no-gutters>
          <b-col lg="4" cols="12">
            <div>
              <p class="font-weight-bold text-capitalize mb-1">Customer</p>
              <ul class="list-unstyled">
                <li class="editor__float_menu__item" @click="insertField('CUSTOMER_NAME')"><font-awesome-icon icon="sort-down"/>Contact Name</li>
                <li class="editor__float_menu__item" @click="insertField('CUSTOMER_EMAIL')"><font-awesome-icon icon="sort-down"/>Email</li>
                <li class="editor__float_menu__item" @click="insertField('CUSTOMER_PHONE')"><font-awesome-icon icon="sort-down"/>Phone</li>
              </ul>
            </div>
          </b-col>
          <b-col lg="4" cols="12">
            <div>
              <p class="font-weight-bold text-capitalize mb-1">Invoice</p>
              <ul class="list-unstyled">
                <li class="editor__float_menu__item" @click="insertField('INVOICE_DATE')"><font-awesome-icon icon="sort-down"/>Date</li>
                <li class="editor__float_menu__item" @click="insertField('INVOICE_DUE_DATE')"><font-awesome-icon icon="sort-down"/>Due Date</li>
                <li class="editor__float_menu__item" @click="insertField('INVOICE_REF_NUMBER')"><font-awesome-icon icon="sort-down"/>Ref Number</li>
              </ul>
            </div>
          </b-col>
          <b-col lg="4" cols="12">
            <div>
              <p class="font-weight-bold text-capitalize mb-1">Company</p>
              <ul class="list-unstyled">
                <li class="editor__float_menu__item" @click="insertField('COMPANY_NAME')"><font-awesome-icon icon="sort-down"/>Company Name</li>
                <li class="editor__float_menu__item" @click="insertField('COMPANY_PHONE')"><font-awesome-icon icon="sort-down"/>Phone</li>
                <li class="editor__float_menu__item" @click="insertField('COMPANY_ADDRESS')"><font-awesome-icon icon="sort-down"/>Address</li>
              </ul>
            </div>
          </b-col>
        </b-row>
      </div>
    </div>
    <editor-content class="editor__content" :editor="editor" />
  </div>
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'
import BaseTextEditorMenu from './BaseTextEditorMenu.vue'
import { createPopper } from '@popperjs/core'

export default {
  components: {
    EditorContent,
    BaseTextEditorMenu
  },

  props: {
    value: {
      type: String,
      default: ''
    }
  },

  data () {
    return {
      content: '',
      popper: null,
      editor: null
    }
  },
  watch: {
    value (value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      if (isSame) {
        return
      }

      this.editor.commands.setContent(this.value, false)
    }
  },
  methods: {
    showInsertFields () {
      // Update position first and then set the visibility
      this.popper.update().then(() => {
        // TODO; This could be set better, maybe do the styles in an object?
        this.$refs.insertFieldPop.style.visibility = 'visible'
        this.$refs.insertFieldPop.style.pointerEvents = 'initial'
      })
    },
    hideInsertFields () {
      // TODO; This could be set better, maybe do the styles in an object?
      this.$refs.insertFieldPop.style.visibility = 'hidden'
      this.$refs.insertFieldPop.style.pointerEvents = 'none'
    },
    insertField (field) {
      this.editor.chain().focus().insertContent(`<b>{${field}}</b>`).run()

      this.hideInsertFields()
    }
  },
  mounted () {
    this.editor = new Editor({
      extensions: [
        ...defaultExtensions()
      ],
      content: this.value,
      onUpdate: () => {
        this.$emit('input', this.editor.getHTML())
      }
    })

    this.$nextTick(function () {
      this.popper = createPopper(this.$refs.insertFieldRef, this.$refs.insertFieldPop, {
        placement: 'bottom-start'
      })
    })
  },
  beforeDestroy () {
    this.editor.destroy()
  }
}
</script>

<style lang="scss">
.editor {
  border: 1px solid #ced4da;
  border-radius: 5px;
  background: #fff;
  position: relative;

  &__header {
    padding: 5px;
    border-bottom: 1px solid #ced4da;
  }

  &__content {
    min-height: 150px;
  }

  &__menu {
    position: absolute;
    bottom: 10px;
    right: 10px;
    z-index: 999;
    width: 100%;

    button {
      float: right;
    }
  }

  &__float_menu {
    background-color: white;
    position: absolute;
    width: 100%;
    visibility: hidden;

    &__item {
      &:hover {
        cursor: pointer;
        background: darken($color: #edf2f7, $amount: 0);
      }

      svg {
        margin-right: 10px;
        transform: rotate(270deg);
      }
    }
  }
}

.ProseMirror {
  min-height: 150px !important;
  padding: 10px;
  color: black;
  outline: none;
}
</style>

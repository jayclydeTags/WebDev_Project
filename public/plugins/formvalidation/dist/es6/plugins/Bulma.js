import e from"../utils/classSet";import t from"./Framework";export default class s extends t{constructor(e){super(Object.assign({},{formClass:"fv-plugins-bulma",messageClass:"help is-danger",rowInvalidClass:"fv-has-error",rowPattern:/^.*field.*$/,rowSelector:".field",rowValidClass:"fv-has-success"},e))}onIconPlaced(t){e(t.iconElement,{"fv-plugins-icon":false});const s=document.createElement("span");s.setAttribute("class","icon is-small is-right");t.iconElement.parentNode.insertBefore(s,t.iconElement);s.appendChild(t.iconElement);const n=t.element.getAttribute("type");const r=t.element.parentElement;if("checkbox"===n||"radio"===n){e(r.parentElement,{"has-icons-right":true});e(s,{"fv-plugins-icon-check":true});r.parentElement.insertBefore(s,r.nextSibling)}else{e(r,{"has-icons-right":true})}}}
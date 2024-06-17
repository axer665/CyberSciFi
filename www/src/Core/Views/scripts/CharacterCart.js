export default class CharacterCart {
    race;
    name;
    sex;
    age;

    container;
    parentDOMElement;

    constructor(race, name, sex, age) {
        this.race = race;
        this.name = name;
        this.sex = sex;
        this.age = age;
        this.container = document.createElement('div');
        this.container.className = "container-character_cart";
        //document.body.append(this.container);

        let block = document.createElement('div');
        block.className = "block-character_cart";
        block.innerHTML = `<p>` +
            `<ul>` +
            `<li>Name: ${this.name}</li>` +
            `<li>Sex: ${this.sex}</li>` +
            `<li>Age: ${this.age}</li>` +
            `</ul>` +
            `</p>`;
        this.container.append(block);
    }

    createDOM = (DOMElement) => {
        const element = document.querySelector(DOMElement)
        try {
            this.parentDOMElement = element;
            element.append(this.container);
        } catch (e) {
            console.log(e);
        }
    }

    removeDOM = () => {
        this.container.remove();
    }
}

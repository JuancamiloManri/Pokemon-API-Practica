document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".container");
  const modal = document.getElementById("modal");
  const closeModal = document.querySelector(".close");
  const modalPokemonName = document.getElementById("modal-pokemon-name");
  const modalAbilities = document.getElementById("modal-abilities");

  fetch("https://pokeapi.co/api/v2/pokemon")
    .then((response) => response.json())
    .then((data) => {
      data.results.forEach((pokemon) => {
        const pokemonCard = document.createElement("div");
        pokemonCard.className = "pokemon-card";

        fetch(pokemon.url)
          .then((response) => response.json())
          .then((pokemonData) => {
            const pokemonImage = document.createElement("img");
            pokemonImage.src = pokemonData.sprites.front_default;
            pokemonImage.alt = pokemon.name;
            pokemonImage.className = "pokemon-image";
            pokemonCard.appendChild(pokemonImage);

            const pokemonName = document.createElement("h3");
            pokemonName.textContent = pokemon.name;
            pokemonName.className = "pokemon-name";
            pokemonCard.appendChild(pokemonName);

            pokemonCard.addEventListener("click", () => {
              modalPokemonName.textContent = pokemon.name;
              modalAbilities.innerHTML = "";

              pokemonData.abilities.forEach((ability) => {
                const abilityItem = document.createElement("li");
                abilityItem.textContent = ability.ability.name;
                modalAbilities.appendChild(abilityItem);
              });

              modal.style.display = "block";
            });

            container.appendChild(pokemonCard);
          });
      });
    });

  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});

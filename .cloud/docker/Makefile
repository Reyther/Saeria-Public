.PHONY: up
up: ## run all containers
	docker-compose -f docker-compose.yml -f docker-compose.local.yml up -d

.PHONY: up-expose
up-expose: ## run all containers with exposed ports
	docker-compose -f docker-compose.yml -f docker-compose.local.yml -f docker-compose.expose.yml up -d

.PHONY: down
down: ## stop all containers
	docker-compose -f docker-compose.yml -f docker-compose.local.yml stop && docker-compose -f docker-compose.yml -f docker-compose.local.yml rm -f

.PHONY: down-expose
down-expose: ## stop all containers with exposed ports
	docker-compose -f docker-compose.yml -f docker-compose.local.yml stop && docker-compose -f docker-compose.yml -f docker-compose.local.yml -f docker-compose.expose.yml rm -f

bash: up ## Connect to workspace container
	docker-compose -f docker-compose.yml -f docker-compose.local.yml exec --user laradock workspace zsh

.PHONY: bash-expose
bash-expose: up-expose ## Connect to workspace container with exposed ports
	docker-compose -f docker-compose.yml -f docker-compose.local.yml -f docker-compose.expose.yml exec --user laradock workspace zsh

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help

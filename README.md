# PHP App + Azure Pipelines + Azure Container Apps Training Lab

This repository contains a minimal PHP web app and an Azure Pipelines configuration that students can use to learn CI/CD fundamentals.

## Learning Goals

By the end of this lab, students should be able to:

1. Build a PHP app in a pipeline.
2. Run unit tests during CI.
3. Build and push a Docker image to Azure Container Registry (ACR).
4. Deploy the container to Azure Container Apps.

## Project Structure

- `index.php`: Simple web entry point.
- `src/GreetingService.php`: App logic.
- `tests/GreetingServiceTest.php`: Unit tests (PHPUnit).
- `Dockerfile`: Container image definition.
- `.dockerignore`: Build context exclusions.
- `composer.json`: Dependencies and scripts.
- `azure-pipelines.yml`: Build + deploy pipeline.

## Run Locally

Prerequisites:

- PHP 8.1+
- Composer 2+

Commands:

```bash
composer install
composer test
php -S localhost:8000
```

Then open: `http://localhost:8000`

## Run As A Container Locally

```bash
docker build -t phpapp-local:latest .
docker run --rm -p 8080:80 phpapp-local:latest
```

Then open: `http://localhost:8080`

## Azure Pipeline Walkthrough

The pipeline in `azure-pipelines.yml` has two stages:

1. `BuildAndTest`
2. `Deploy`

### BuildAndTest stage

This stage does the following:

1. Selects PHP version 8.2.
2. Validates and installs Composer dependencies.
3. Runs `composer test` (PHPUnit).

### Deploy stage

This stage:

1. Logs into Azure and ensures Container Apps extension is available.
2. Builds a Docker image from `Dockerfile`.
3. Pushes the image to Azure Container Registry.
4. Creates/updates Azure Container Apps environment.
5. Creates or updates the Azure Container App with the latest image.

## One-Time Azure Setup for Students

Before running the pipeline:

1. Create an Azure Container Registry (ACR). Enable admin user for this training lab.
2. Create (or let pipeline create) a resource group and Container Apps environment.
2. In Azure DevOps, create an Azure Resource Manager service connection.
3. Update these variables in `azure-pipelines.yml`:
	- `azureServiceConnection`
	- `resourceGroup`
	- `location`
	- `containerAppEnvironment`
	- `containerAppName`
	- `acrName`

## Suggested Classroom Exercises

1. Break a test on purpose and observe pipeline failure.
2. Add a new route/feature and corresponding test.
3. Add branch policy so PRs require successful `BuildAndTest`.
4. Add environment approval for the `training` environment before deploy.
5. Add revision labels in Container Apps and practice rollback.

## Notes

- This is intentionally simple so students can focus on pipeline concepts.
- For production apps, use managed identity between Container Apps and ACR instead of admin credentials.
- Also add security scanning, secret management, and multi-environment release strategy.
# PHP App + Azure Pipelines Training Lab

This repository contains a minimal PHP web app and an Azure Pipelines configuration that students can use to learn CI/CD fundamentals.

## Learning Goals

By the end of this lab, students should be able to:

1. Build a PHP app in a pipeline.
2. Run unit tests during CI.
3. Publish a deployable artifact.
4. Deploy to Azure App Service using a CD stage.

## Project Structure

- `index.php`: Simple web entry point.
- `src/GreetingService.php`: App logic.
- `tests/GreetingServiceTest.php`: Unit tests (PHPUnit).
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

## Azure Pipeline Walkthrough

The pipeline in `azure-pipelines.yml` has two stages:

1. `BuildAndTest`
2. `Deploy`

### BuildAndTest stage

This stage does the following:

1. Selects PHP version 8.2.
2. Validates and installs Composer dependencies.
3. Runs `composer test` (PHPUnit).
4. Creates a zip artifact for deployment.
5. Publishes the artifact.

### Deploy stage

This stage:

1. Downloads the artifact from CI.
2. Deploys it to Azure Web App (Linux) using `AzureWebApp@1`.

## One-Time Azure Setup for Students

Before running the pipeline:

1. Create an Azure Web App (Linux) with PHP 8.2 runtime.
2. In Azure DevOps, create an Azure Resource Manager service connection.
3. Update these values in `azure-pipelines.yml`:
	- `azureSubscription`: your service connection name.
	- `appName`: your Azure Web App name.

## Suggested Classroom Exercises

1. Break a test on purpose and observe pipeline failure.
2. Add a new route/feature and corresponding test.
3. Add branch policy so PRs require successful `BuildAndTest`.
4. Add environment approval for the `training` environment before deploy.

## Notes

- This is intentionally simple so students can focus on pipeline concepts.
- For production apps, add secrets management, security scanning, and multi-environment release strategy.
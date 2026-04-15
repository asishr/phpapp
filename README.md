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

1. Verifies PHP and Composer are available on the build agent.
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
3. In Azure DevOps, create an Azure Resource Manager service connection.
4. Update these variables in `azure-pipelines.yml`:
   - `azureServiceConnection`
   - `resourceGroup`
   - `location`
   - `containerAppEnvironment`
   - `containerAppName`
   - `acrName`

## Student Lab Guide (Step-by-Step)

Use this section as a classroom walkthrough.

### Step 1: Fork or clone the repository

```bash
git clone https://github.com/asishr/phpapp.git
cd phpapp
```

### Step 2: Validate the app runs locally

```bash
composer install
composer test
php -S localhost:8000
```

Open `http://localhost:8000` and verify the greeting page loads.

### Step 3: Build and run the container locally

```bash
docker build -t phpapp-local:latest .
docker run --rm -p 8080:80 phpapp-local:latest
```

Open `http://localhost:8080` and verify the same page works in a container.

### Step 4: Prepare Azure resources

Create or confirm these resources in Azure:

1. Azure Container Registry (ACR)
2. Resource Group
3. Azure Container Apps Environment

Note the resource names for the next step.

### Step 5: Configure Azure DevOps service connection

In Azure DevOps Project Settings:

1. Open `Service connections`.
2. Create an `Azure Resource Manager` connection.
3. Copy the connection name.

### Step 6: Configure pipeline variables

Edit `azure-pipelines.yml` and set:

1. `azureServiceConnection` to your service connection name
2. `resourceGroup` to your Azure resource group
3. `location` to your Azure region (example: `eastus`)
4. `containerAppEnvironment` to your Container Apps environment name
5. `containerAppName` to the app name you want to deploy
6. `acrName` to your ACR name (without `.azurecr.io`)

Commit and push your changes.

### Step 7: Create and run the Azure Pipeline

In Azure DevOps:

1. Go to `Pipelines`.
2. Create a new pipeline from this repository.
3. Select existing YAML file: `azure-pipelines.yml`.
4. Run the pipeline.

### Step 8: Observe what the pipeline does

Watch stage output:

1. `BuildAndTest`: installs dependencies and runs PHPUnit
2. `Deploy`: builds Docker image, pushes to ACR, deploys to Container Apps

### Step 9: Verify deployment in Azure

After success:

1. Open Azure Portal
2. Open your Azure Container App
3. Copy the application URL (ingress)
4. Open the URL in a browser and test the app

### Step 10: Make a change and redeploy

1. Update greeting text in `src/GreetingService.php`
2. Update tests in `tests/GreetingServiceTest.php`
3. Commit and push
4. Re-run the pipeline and verify new behavior in Azure

## Common Student Errors and Fixes

1. `ACR not found`: check `acrName` value and subscription in the service connection.
2. `Permission denied`: verify the service connection has rights to resource group and ACR.
3. `ContainerApp environment not found`: check `containerAppEnvironment` and `resourceGroup` names.
4. `Pipeline YAML validation failed`: ensure indentation uses spaces, not tabs.

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
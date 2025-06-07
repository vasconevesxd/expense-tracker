FROM node:20

# Set working directory
WORKDIR /app

# Copy Quasar project
COPY . /app

# Install dependencies
RUN npm install

# Install Quasar CLI globally
RUN npm install -g @quasar/cli

# Expose port for Quasar dev server
EXPOSE 9000

# Start Quasar development server
CMD ["quasar", "dev"]
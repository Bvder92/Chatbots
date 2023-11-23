import transformers
import torch

model_name = "OpenLLM-France/Claire-7B-0.1"

tokenizer = transformers.AutoTokenizer.from_pretrained(model_name)
model = transformers.AutoModelForCausalLM.from_pretrained(model_name,
    device_map="auto",
    torch_dtype=torch.bfloat16,
    load_in_4bit=True                          # For efficient inference, if supported by the GPU card
)

pipeline = transformers.pipeline("text-generation", model=model, tokenizer=tokenizer)
generation_kwargs = dict(
    num_return_sequences=1,                    # Number of variants to generate.
    return_full_text= False,                   # Do not include the prompt in the generated text.
    max_new_tokens=200,                        # Maximum length for the output text.
    do_sample=True, top_k=10, temperature=1.0, # Sampling parameters.
    pad_token_id=tokenizer.eos_token_id,       # Just to avoid a harmless warning.
)

prompt = """\
- Bonjour Dominique, qu'allez-vous nous cuisiner aujourd'hui ?
- Bonjour Camille,\
"""
completions = pipeline(prompt, **generation_kwargs)
for completion in completions:
    print(prompt + " […]" + completion['generated_text'])

